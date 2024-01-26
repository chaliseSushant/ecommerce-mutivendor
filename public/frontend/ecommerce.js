$( function() {
    $("#slider-range" ).slider({
        range: true,
        min: 0,
        max: 50000,
        values: [ 0, 50000 ],
        slide: function( event, ui ) {
            $( "#amount" ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
        }
    });
    $( "#amount" ).val(  $( "#slider-range" ).slider( "values", 0 ) +
        " - " + $( "#slider-range" ).slider( "values", 1 ) );

    $('[data-toggle="tooltip"]').tooltip();

});

$('#lightSlider').lightSlider({
    gallery: true,
    item: 1,
    loop:true,
    slideMargin: 0,
    thumbItem: 9,
    onSliderLoad: function (el) {
        el.find('li').zoom();
    }
});
// Prevent closing from click inside dropdown
$(document).on('click', '.dropdown-menu', function (e) {

    if(!event.target.classList.contains('child'))
    {
        e.stopPropagation();
    }

});

// make it as accordion for smaller screens
if ($(window).width() < 992) {
    $('.dropdown-menu a').click(function(e){
        if($(this).next('.submenu').length){
            e.preventDefault();
            $(this).next('.submenu').toggle();
        }
        $('.dropdown').on('hide.bs.dropdown', function () {
            $(this).find('.submenu').hide();
        })
    });
}
/*Action Nav*/
$(document).ready(function(){
    // Show hide popover
    $(".dropdown").click(function(){
        $(this).find(".dropdown-content").slideToggle("fast");
    });
});
$(document).on("click", function(event){
    var $trigger = $(".dropdown");
    if($trigger !== event.target && !$trigger.has(event.target).length){
        $(".dropdown-content").slideUp("fast");
    }
});
function copyToClipboard(text) {
    var inputc = document.body.appendChild(document.createElement("input"));
    inputc.value = window.location.href;
    inputc.focus();
    inputc.select();
    document.execCommand('copy');
    inputc.parentNode.removeChild(inputc);
    alert("URL Copied.");

}


function sortSearchProducts(){
    var option = document.getElementById("sortProduct").value;
    window.location = option;
}

/*
Action Nav*/

/*
/!*Progress Bar*!/
const progress = document.getElementById("progress");
const previousBtn = document.getElementById("prev");
const nextBtn = document.getElementById("next");
const stepCircles = document.querySelectorAll(".circle");

 currentActive = 1;

nextBtn.addEventListener("click", () => {
    currentActive++;

    if (currentActive > stepCircles.length) {
        currentActive = stepCircles.length;
    }

    update();
});

previousBtn.addEventListener("click", () => {
    currentActive--;

if (currentActive < 1) {
    currentActive = 1;
}

update();
});

function update() {
    stepCircles.forEach((circle, i) => {
        if (i < currentActive) {
        circle.classList.add("active");
    }
    else {
        circle.classList.remove("active");
    }
});

    const activeCircles = document.querySelectorAll(".active");
    progress.style.width =
        ((activeCircles.length - 1) / (stepCircles.length - 1)) * 100 + "%";

    if (currentActive === 1) {
        previousBtn.disabled = true;
    } else if (currentActive === stepCircles.length) {
        nextBtn.disabled = true;
    } else {
        previousBtn.disabled = false;
        nextBtn.disabled = false;
    }
}

/!*Progress Bar*!/
*/
