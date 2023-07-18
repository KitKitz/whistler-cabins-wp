document.addEventListener('DOMContentLoaded', function(){
  const topicBtns = document.querySelectorAll('.topic');
  const qaWrappers = document.querySelectorAll('.qa-wrapper');
  const questions = document.querySelectorAll('.question');

  qaWrappers[0].style.display = 'block';
  
  // FAQ Topics
  topicBtns.forEach((btn, btnIndex) => {
    btn.onclick = function(){
      console.log('click');
      btn.classList.toggle('active');

      qaWrappers.forEach((wrapper, wrapperIndex) => {
        wrapper.style.display = wrapperIndex === btnIndex ? 'block' : 'none';
      });
    }
  });


  // Question-Answer Pairs
  questions.forEach((q) => {
    q.onclick = function() {
      this.classList.toggle('expand');
      let content = this.nextElementSibling;
      let computedStyle = window.getComputedStyle(content);
  
      if (computedStyle.getPropertyValue('max-height') === '0px') {
        content.style.maxHeight = content.scrollHeight + 'px';
      } else {
        content.style.maxHeight = '0px';
      }
    };
  });  

});