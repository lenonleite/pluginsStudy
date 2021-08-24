<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'es_cls_job_subscribe' ) ) {
	class es_cls_job_subscribe {

		public function __construct( $isActionsNeeded ) {
			if ( defined( 'DOING_AJAX' ) && ( true === DOING_AJAX ) && ( true === $isActionsNeeded ) ) {
				add_action( 'wp_ajax_es_add_subscriber', array( $this, 'es_add_subscriber' ), 10 );
				add_action( 'wp_ajax_nopriv_es_add_subscriber', array( $this, 'es_add_subscriber' ), 10 );
			}
		}

		public static function getInstance( $isActionsNeeded = true ) {
			static $es_cls_job_subscribe_obj = null;
			if ( null === $es_cls_job_subscribe_obj ) {
				$es_cls_job_subscribe_obj = new es_cls_job_subscribe( $isActionsNeeded );
			}

			return $es_cls_job_subscribe_obj;
		}


		public function es_add_subscriber() {

			$es_response = $this->es_add_subscribers_db();
			echo json_encode( $es_response );
			die();
		}

		public function es_add_subscribers_db() {
			$es_response = array();

			//honey-pot validation

			$hp_key = "esfpx_es_hp_" . wp_create_nonce('es_hp');
			if ( !isset( $_POST[$hp_key] ) || !empty( $_POST[$hp_key] ) ) {
				$es_response['error'] = 'unexpected-error';
				return $es_response;
			}

			/*
			 * We have fixed spam issue in ES 3.5.16.
			 * So, we don't have to do *.ru restriction again here
			//block address list
			$es_disposable_list = array( '\.ru' );
			if ( preg_match( '/(' . implode( '|', $es_disposable_list ) . ')$/i', trim( $_POST['esfpx_es_txt_email'] ) ) ) {
				$es_response['error'] = 'unexpected-error';
				$echoAble             = json_encode( $es_response );

				return $es_response;
			}
			*/

			if ( ( isset( $_POST['es'] ) ) && ( 'subscribe' === $_POST['es'] ) && !empty( $_POST['esfpx_es-subscribe'] ) ) {

				foreach ( $_POST as $key => $value ) {
					$new_key           = str_replace( '_pg', '', $key );
					$_POST[ $new_key ] = $value;
				}

				$es_subscriber_name  = isset( $_POST['esfpx_es_txt_name'] ) ? trim( $_POST['esfpx_es_txt_name'] ) : '';
				$es_subscriber_email = isset( $_POST['esfpx_es_txt_email'] ) ? trim( $_POST['esfpx_es_txt_email'] ) : '';
				$es_subscriber_group = isset( $_POST['esfpx_es_txt_group'] ) ? trim( $_POST['esfpx_es_txt_group'] ) : '';
				$es_nonce            = $_POST['esfpx_es-subscribe'];

				$subscriber_form = array(
					'es_email_name'   => '',
					'es_email_mail'   => '',
					'es_email_group'  => '',
					'es_email_status' => '',
					'es_nonce'        => ''
				);

				if ( $es_subscriber_group == '' ) {
					$es_subscriber_group = 'Public';
				}

				if ( $es_subscriber_email != '' ) {
					if ( ! filter_var( $es_subscriber_email, FILTER_VALIDATE_EMAIL ) ) {
						$es_response['error'] = 'invalid-email';
					} else {
						$action = '';
						global $wpdb;

						$subscriber_form['es_email_name']  = $es_subscriber_name;
						$subscriber_form['es_email_mail']  = $es_subscriber_email;
						$subscriber_form['es_email_group'] = $es_subscriber_group;
						$subscriber_form['es_nonce']       = $es_nonce;

						$es_optintype = get_option( 'ig_es_optintype' );

						if ( $es_optintype == "Double Opt In" ) {
							$subscriber_form['es_email_status'] = "Unconfirmed";
						} else {
							$subscriber_form['es_email_status'] = "Single Opt In";
						}
						//validate lead
						$action = es_cls_dbquery::es_view_subscriber_widget( $subscriber_form );
						if ( $action == "sus" ) {
							$subscribers = es_cls_dbquery::es_view_subscriber_one( $es_subscriber_email, $es_subscriber_group );
							if ( $es_optintype == "Double Opt In" ) {
								es_cls_sendmail::es_sendmail( "optin", $template = 0, $subscribers, "optin", 0 );
								$es_response['success'] = 'subscribed-pending-doubleoptin';
							} else {
								$es_c_usermailoption = get_option( 'ig_es_welcomeemail' );
								if ( $es_c_usermailoption == "YES" ) {
									es_cls_sendmail::es_sendmail( "welcome", $template = 0, $subscribers, "welcome", 0 );
								}
								$es_response['success'] = 'subscribed-successfully';
							}
						} elseif ( $action == "ext" ) {
							$es_response['success'] = 'already-exist';
						} elseif ( $action == "invalid" ) {
							$es_response['error'] = 'invalid-email';
						} elseif($action == "rate-limit") {
							$es_response['error'] = 'rate-limit';
						}
					}
				} else {
					$es_response['error'] = 'no-email-address';
				}
			} else {
				$es_response['error'] = 'unexpected-error-1';
			}

			return $es_response;
		}
	}

	$es_cls_job_subscribe_obj = es_cls_job_subscribe::getInstance(true);
}