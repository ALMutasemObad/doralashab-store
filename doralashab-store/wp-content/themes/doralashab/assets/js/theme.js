document.documentElement.classList.add('da-js');
document.addEventListener('DOMContentLoaded',()=>{
  const button=document.querySelector('.da-menu-toggle');
  const nav=document.querySelector('.main-navigation');
  if(button&&nav){
    button.addEventListener('click',()=>{
      const open=nav.classList.toggle('is-open');
      button.setAttribute('aria-expanded',String(open));
      if(open) document.querySelector('.site-header')?.classList.remove('is-header-collapsed');
    });
    nav.querySelectorAll('a').forEach(link=>link.addEventListener('click',()=>{
      nav.classList.remove('is-open');
      button.setAttribute('aria-expanded','false');
    }));
  }

  const header=document.querySelector('.site-header');
  const syncBrandingHeight=()=>{
    if(header)document.documentElement.style.setProperty('--da-branding-height',`${Math.ceil(header.offsetHeight)}px`);
  };
  syncBrandingHeight();
  if(header&&'ResizeObserver' in window){
    new ResizeObserver(syncBrandingHeight).observe(header);
  }else{
    window.addEventListener('resize',syncBrandingHeight,{passive:true});
  }
  let lastScrollY=window.scrollY;
  let scrollDirection=0;
  let directionTravel=0;
  let headerTicking=false;
  const setHeaderState=()=>{
    if(!header)return;
    const currentScrollY=window.scrollY;
    const delta=currentScrollY-lastScrollY;
    const nextDirection=delta>0?1:delta<0?-1:0;
    if(nextDirection&&nextDirection!==scrollDirection){
      scrollDirection=nextDirection;
      directionTravel=0;
    }
    directionTravel+=Math.abs(delta);
    header.classList.toggle('is-scrolled',currentScrollY>20);
    const collapseBoundary=header.offsetHeight+8;
    if(currentScrollY<collapseBoundary||nav?.classList.contains('is-open')){
      header.classList.remove('is-header-collapsed');
	  directionTravel=0;
    }else if(scrollDirection===1&&directionTravel>16){
      header.classList.add('is-header-collapsed');
	  directionTravel=0;
    }else if(scrollDirection===-1&&directionTravel>10){
      header.classList.remove('is-header-collapsed');
	  directionTravel=0;
    }
    lastScrollY=currentScrollY;
    headerTicking=false;
  };
  setHeaderState();
  window.addEventListener('scroll',()=>{
    if(!headerTicking){
      window.requestAnimationFrame(setHeaderState);
      headerTicking=true;
    }
  },{passive:true});

  const countdown=document.querySelector('[data-campaign-countdown]');
  if(countdown){
    const target=new Date(countdown.dataset.target).getTime();
    const fields={
      days:countdown.querySelector('[data-days]'),
      hours:countdown.querySelector('[data-hours]'),
      minutes:countdown.querySelector('[data-minutes]'),
      seconds:countdown.querySelector('[data-seconds]')
    };
    const pad=value=>String(Math.max(0,value)).padStart(2,'0');
    let timer;
    const renderCountdown=()=>{
      const remaining=Math.max(0,target-Date.now());
      const days=Math.floor(remaining/86400000);
      const hours=Math.floor((remaining%86400000)/3600000);
      const minutes=Math.floor((remaining%3600000)/60000);
      const seconds=Math.floor((remaining%60000)/1000);
      fields.days.textContent=pad(days);
      fields.hours.textContent=pad(hours);
      fields.minutes.textContent=pad(minutes);
      fields.seconds.textContent=pad(seconds);
      if(!remaining){
        countdown.classList.add('is-ended');
        const label=countdown.querySelector(':scope > p');
        if(label)label.textContent='انتهى العرض الموسمي';
        if(timer)window.clearInterval(timer);
      }
    };
    renderCountdown();
    timer=window.setInterval(renderCountdown,1000);
  }

  if(window.jQuery){
    window.jQuery(document.body).on('added_to_cart',(_event,_fragments,_hash,button)=>{
      if(button?.hasClass('da-campaign-add'))button.find('span').text('تمت الإضافة');
    });
  }

  const items=document.querySelectorAll('[data-reveal]');
  if(!items.length)return;
  if(window.matchMedia('(prefers-reduced-motion: reduce)').matches){
    items.forEach(item=>item.classList.add('is-visible'));
    return;
  }
  const observer=new IntersectionObserver(entries=>{
    entries.forEach(entry=>{
      if(entry.isIntersecting){
        entry.target.classList.add('is-visible');
        observer.unobserve(entry.target);
      }
    });
  },{threshold:.12,rootMargin:'0px 0px -40px'});
  items.forEach(item=>observer.observe(item));
});
