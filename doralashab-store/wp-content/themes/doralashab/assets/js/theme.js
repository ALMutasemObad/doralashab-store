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
  let lastScrollY=window.scrollY;
  let headerTicking=false;
  const setHeaderState=()=>{
    if(!header)return;
    const currentScrollY=window.scrollY;
    const delta=currentScrollY-lastScrollY;
    header.classList.toggle('is-scrolled',currentScrollY>20);
    if(currentScrollY<70||nav?.classList.contains('is-open')){
      header.classList.remove('is-header-collapsed');
    }else if(delta>2){
      header.classList.add('is-header-collapsed');
    }else if(delta<-2){
      header.classList.remove('is-header-collapsed');
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
