/**
 * sticky js
 */
;
(function (Themify,Win) {
    'use strict';
	let timer,
	t1,
	isDisable=false,
	vWidth=Themify.w,
	vHeight=Themify.h,
	isAdded=false;
	const map = new Map(),
		tablet=tbLocalScript['is_sticky']==='m'?parseInt(tbLocalScript.breakpoints.tablet[1]):false,
		_scroller=function(e,item){
			if(timer){
				cancelAnimationFrame(timer);
			}
			if(isDisable===true){
				return;
			}
			const self=e?this:Win;
				timer = requestAnimationFrame(function(){
				const offset=self.pageYOffset,
					items=item?item:map;
				for (let entry of items) {
					let el =entry[0],
						opt=entry[1],
						isFixed=el.classList.contains('tb_sticky_scroll_active');
					if(opt==='disable'){
						continue;
					}
					if((opt.isBottom===true && ((offset+vHeight)>=opt.space)) || (opt.isBottom!==true &&offset>=opt.space)){
						if(isFixed===false){
							el.style['width']= opt.w+'px';
							el.parentNode.style['height']= opt.h+'px';
							el.style['position']= 'fixed';
							if(opt.isBottom===true){
								el.style['bottom']= opt.value;
							}
							else{
								el.style['top']= opt.value;
							}
							el.classList.add('tb_sticky_scroll_active');
						}
						if(opt.unstick && opt.unstick.item){
							let unstick=opt.unstick,
								v=parseInt(opt.value),
								b=unstick.item.getBoundingClientRect(),
								newTop;
							if(unstick.type==='builder'){
								newTop=b.bottom - opt.h - v;
							}
							else{
								if(unstick.r==='passes'){
									newTop=b.bottom - v;
								}
								else{
									newTop=b.top-opt.h- v;
								}
								if(unstick.cur==='top' || unstick.cur==='bottom'){
									newTop+=unstick.v;
									if(unstick.cur==='bottom'){
										newTop-=vHeight;
									}
								}
							}
							newTop=newTop < 0?(newTop+v+'px'):opt.value;
							if(opt.currentTop!==newTop){
								opt.currentTop=newTop;
								map.set(el,opt);
								el.style['top']=newTop;
							}
						}
					}
					else if(isFixed===true){
						_unsticky(el);
					}
				}
			});
	},
	_unsticky=function(el){
		el.style['width']=el.style['top']=el.style['bottom']=el.style['position']=el.parentNode.style['height']= '';
		el.classList.remove('tb_sticky_scroll_active');
	},
    _resize = function (e) {
		vWidth=e.w;
		vHeight=e.h;
		isDisable = !!(tablet && tablet>=vWidth);
		for (let entry of map) {
			if(isDisable===true){
				_unsticky(entry[0]);
			}
			else{
				_init(entry[0],null,true);
			}
		}
		if(isDisable===false){
			_scroller();
		}
    },
	getCurrentBreakpointValues=function(vals){
		let found=false;
		const bp=tbLocalScript.breakpoints,
			items=Object.keys(bp);
		for(let i=items.length-1;i>-1;--i){
			let p=items[i],
				k=p==='tablet_landscape'?'tl':p[0];
			if(vals[k]!==undefined){
				let v=p!=='mobile'?bp[p][1]:bp[p];
				if(v>=vWidth){
					found=vals[k];
					break;
				}
			}
		}
		if(found===false){
			found=vals.d;
		}
		return found;
	},
	mutationObserver = new MutationObserver(function (mut) {
		if (mut[0]) {
			let t=mut[0].target.closest('[data-sticky-active]');
			if(t){
				if(t1){
					cancelAnimationFrame(t1);
				}
				t1=requestAnimationFrame(function(){
					Themify.imagesLoad(t,function(){
						const tmp = new Map();
						_unsticky(t);
						_init(t);
						tmp.set(t,map.get(t));
						_scroller(null,tmp);
						t=t1=null;
					});
				});
			}
		}
	}),
	_init=function(el,box,recreate){
		const isFixed=el.classList.contains('tb_sticky_scroll_active');
		if(isFixed===false || recreate===true){
			if(!map.has(el) || recreate===true){
				const opt=getCurrentBreakpointValues(JSON.parse(el.getAttribute('data-sticky-active')));
				if(!opt){
					map.set(el,'disable');
					_unsticky(el);
					return;
				}
				const stick=opt.stick || {},
					stickVal=stick.v?parseInt(stick.v):0,
				unstick=opt.unstick,
				u=stick.u || 'px';
				if(u!=='px'){
					opt.u=u;
					opt.v= stickVal;
				}
				else{
					opt.value= (stickVal+u);
				}
				if(stick.p==='bottom'){
					opt.isBottom= true;
				}
				if(unstick){
					let unstickItem,
					builder=el.closest('.themify_builder_content');
                    if('builder'===unstick.type){
						let tmp=builder.closest('#tbp_header');
                        if(tmp){
                            tmp=document.getElementById('tbp_content');
                            tmp=tmp!==null?tmp.getElementsByClassName('themify_builder_content')[0]:document.getElementsByClassName('themify_builder_content')[1];
                            if(tmp){
                                builder=tmp;
                            }
                        }
						unstickItem = builder;
					}
					else{
						if('row'===unstick.type){
							unstickItem=builder.getElementsByClassName('tb_'+unstick.el)[0];
						}
						if(!unstickItem){
							unstickItem=builder.getElementsByClassName('tb_'+unstick.el)[0];
						}
						if(unstickItem){
							unstick.v=parseInt(unstick.v);
						}
					}
					if(unstickItem){
						unstick.item=unstickItem;
					}
				}
				if(!el.parentNode.classList.contains('tb_sticky_wrapper')){
					const wrapper=document.createElement('div')
					wrapper.className='tb_sticky_wrapper';
					el.parentNode.insertBefore(wrapper, el);
					wrapper.appendChild(el);
				}
				map.set(el,opt);
			}
			const vals=map.get(el);
			if(vals==='disable'){
				return;
			}
			if(vals.u ==='%' && vals.v!==0){
				const v=(vals.v/100)*vHeight;
				vals.value= v+'px';
			}
			const t=parseFloat(vals.value);
			if(isFixed===true){
				el.style['position']='';
			}
			if(!box){
				box=el.getBoundingClientRect();
			}
			vals.w= box.width>0?box.width:el.offsetWidth;
			vals.h= box.height>0?box.height:el.offsetHeight;
			vals.space= vals['isBottom']!==undefined?(box.bottom+Win.pageYOffset+t):(box.top+Win.pageYOffset-t);
			vals.t=box.top;
			if(el.parentNode.style['height']!==(vals.h+'px')){
				el.parentNode.style['height']=vals.h+'px';
			}
			if(isFixed===true){
				el.style['position']='fixed';
			}
			map.set(el,vals);
		}
	},
	observer = new IntersectionObserver(function (entries, _self) {//only need for recalculate the positions,width/height and etc, will be replaced with ResizeObserver in the future
		for (let i = entries.length - 1; i > -1; --i) {
			if (entries[i].isIntersecting === true) {
				_init(entries[i].target,entries[i].boundingClientRect);
			}
		}
	}, {
		 threshold:[.3,.4,.5,.6,.7,.8,.9,1]
	});
    Themify.on('tb_sticky_init',function(items){
        if(items instanceof jQuery){
            items = items.get();
        }
		for (let i = items.length - 1; i > -1; --i) {
			observer.observe(items[i]);
			mutationObserver.observe(items[i], {subtree:true,childList:true});
		}
		if(isAdded===false){
			isAdded=true;
			if(Win.pageYOffset>0){
				for (let i = items.length - 1; i > -1; --i) {
					_init(items[i],items[i].getBoundingClientRect());
				}
				_scroller();
			}
			Win.addEventListener('scroll',_scroller,{passive:true});
		}
    })
    .on('tfsmartresize',_resize);
	
	

})(Themify,window);
