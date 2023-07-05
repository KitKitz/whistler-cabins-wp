// script will execute after the page has finished loading
document.addEventListener('DOMContentLoaded', function (){
  const btnQA = document.querySelectorAll('.btn-qa');

  console.log(btnQA);
  
  btnQA.forEach((btn) => {
    btn.onclick = function(){
      this.classList.toggle('expand');
      let content = this.nextElementSibling;

      // on first load, content has a max-height of 0
      // on click, the max height is removed, ie null
      // i need to change this code so that if maxheight is at 0, 
      //  content.style.maxHeight = content.scrollHeight + 'px';
      // else,then it will be changed to max height 0 
      if (content.style.maxHeight === '0px'){
        content.style.maxHeight = content.scrollHeight + 'px';
      }
      else {
        content.style.maxHeight = '0px';
      }

    };          
  });  
});