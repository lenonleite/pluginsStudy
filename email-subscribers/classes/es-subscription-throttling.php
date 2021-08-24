<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class es_cls_subscription_throttaling {

	static function throttle() {

		global $wpdb;

		if ( ! ( is_user_logged_in() && is_super_admin() ) ) {

			$subscriber_ip = es_cls_helpers::getUserIP();

			if ( ! empty( $subscriber_ip ) ) {

				$query   = "SELECT count(*) as count from {$wpdb->prefix}es_subscriber_ips WHERE ip = %s AND ( `created_on` >= NOW() - INTERVAL %s SECOND )";
				$results = $wpdb->get_col( $wpdb->prepare( $query, $subscriber_ip, DAY_IN_SECONDS ) );

				$subscribers = array_shift( $results );

				if ( $subscribers > 0 ) {
					$timeout = MINUTE_IN_SECONDS * pow( 2, $subscribers - 1 );

					$query   = "SELECT count(*) as count from {$wpdb->prefix}es_subscriber_ips WHERE ip = %s AND ( `created_on` >= NOW() - INTERVAL %s SECOND ) LIMIT 1";
					$results = $wpdb->get_col( $wpdb->prepare( $query, $subscriber_ip, $timeout ) );

					$subscribers = array_shift( $results );

					if ( ! empty( $subscribers ) ) {
						return $timeout;
					}
				}

				// Add IP Address.
				$query  = "INSERT INTO {$wpdb->prefix}es_subscriber_ips (`ip`) VALUES (%s)";
				$insert = $wpdb->query( $wpdb->prepare( $query, $subscriber_ip ) );

				// Delete older entries
				$query  = "DELETE FROM {$wpdb->prefix}es_subscriber_ips WHERE (`created_on` < NOW() - INTERVAL %s SECOND )";
				$delete = $wpdb->query( $wpdb->prepare( $query, DAY_IN_SECONDS ) );
			}
		}

		return false;
	}

}