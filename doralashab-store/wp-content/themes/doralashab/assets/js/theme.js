document.documentElement.classList.add('da-js');
document.addEventListener('DOMContentLoaded',()=>{
  const button=document.querySelector('.da-menu-toggle');
  const nav=document.querySelector('.main-navigation');
  if(button&&nav){
    button.addEventListener('click',()=>{
      const open=nav.classList.toggle('is-open');
      button.setAttribute('aria-expanded',String(open));
    });
    nav.querySelectorAll('a').forEach(link=>link.addEventListener('click',()=>{
      nav.classList.remove('is-open');
      button.setAttribute('aria-expanded','false');
    }));
  }

  const header=document.querySelector('.site-header');
  const setHeaderState=()=>header?.classList.toggle('is-scrolled',window.scrollY>20);
  setHeaderState();
  window.addEventListener('scroll',setHeaderState,{passive:true});

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
