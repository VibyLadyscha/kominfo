window.addEventListener('load', function() {
    var bars = document.querySelectorAll('.bar_1, .bar_2, .bar_3, .bar_4');
    var bodyHeight = document.body.scrollHeight;
    bars.forEach(function(bar) {
        bar.style.height = bodyHeight + 'px';
    });
});