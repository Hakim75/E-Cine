const $video = document.querySelector('video');
const $start =  document.querySelector('.play-video');
setTimeout(()=>{
    $start.classList.add("hide");
    $video.play();
},3000);