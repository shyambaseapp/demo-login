/*reset timer : */
function reset_timer(){
         var x = setInterval(function() {
         var now = new Date().getTime();
         var t = now;
         var days = Math.floor(t / (1000 * 60 * 60 * 24));
         var hours = 24-Math.floor((t%(1000 * 60 * 60 * 24))/(1000 * 60 * 60));
         var minutes = 60-Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
         var seconds = 60-Math.floor((t % (1000 * 60)) / 1000);
         document.getElementById("demo").innerHTML  = hours + "h " + minutes + "M " + seconds + "S ";
     }, 1000);
}
reset_timer();
