// script will execute after the page has finished loading
document.addEventListener('DOMContentLoaded', function(){
  const btnTopic = document.querySelectorAll('.btn-topic');
  const btnQA = document.querySelectorAll('.btn-qa');

  // Note: fix display siblings of first instance on load

  btnTopic.forEach((btnT) => {
    btnT.onclick = function(){
      this.classList.toggle('active');

      // selects all children of this button's parent, excluding itself, and change display to 'block'
      const siblings = Array.from(this.parentNode.children).filter(child => child !== this);
      siblings.forEach(sibling => {
        sibling.style.display = 'block';
      });


      btnTopic.forEach((button) => {
        if (button !== this){
          const notSiblings = Array.from(button.parentNode.children).filter(child => child !== button);
          notSiblings.forEach(notSibling => {
            notSibling.style.display = 'none';
          });
        }
      });
    };          
  });  
  
  btnQA.forEach((btnQ) => {
    btnQ.onclick = function(){
      this.classList.toggle('expand');
      let content = this.nextElementSibling;
 
      if (content.style.maxHeight === '0px'){
        content.style.maxHeight = content.scrollHeight + 'px';
      }
      else {
        content.style.maxHeight = '0px';
      }

    };          
  });  
});