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
