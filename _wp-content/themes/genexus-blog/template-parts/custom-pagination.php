<?php
$pagination = $args[0];
$search_value = $args[1];
$traditional_pagination = $args[2]; //this is the pagination only used in search.php
?>

<script>
const searchValue = '<?php echo $search_value ;?>';
</script>

<?php
if($pagination) {


    $paginationResultClasses = 'pagination';
    if($traditional_pagination) {
        $paginationResultClasses .= ' pagination--traditional';
    }
    if(count($pagination) > 5) {
        //if pagination is greater than 5, let's use flickiry slider
        $paginationResultClasses .= ' pagination--with-slider';
    };
    
    $paginationResult = '<ul class="'.$paginationResultClasses.'">';
    $counter = 1;
    
    foreach ($pagination as $pag) {
        $pag_classes = 'pagination__pag';
        if (strpos($pag, 'current') !== false) {
            $pag_classes .= ' pagination__pag--active';
        }
        if($pagination > 5) {
            //if pagination is greater than 5, add carousel-cell for the slider to work properly
            $paginationResult .= '<li class="carousel-cell"><span class="'.$pag_classes.'">'.$counter.'</span></li>';
        } else {
            //just the li
            $paginationResult .= '<li class="'.$pag_classes.'">'.$counter.'</li>';
        }
        $counter += 1;
    }

    $paginationResult .= '</ul>';
    if($traditional_pagination) {
        $paginationResult .= '<script>
            window.onload = function() {
                const paginationPags = document.querySelectorAll(".pagination .pagination__pag");
                paginationPags.forEach((pag,i) => {
                    pag.addEventListener("click", ()=> {
                        window.location.href= `?s=${searchValue}&page=${i+1}`;
                    });
                });
            };
        </script>';
} else {
    $paginationResult .= '<script>
    window.onload = function() {
        const liveSearchObj = liveSearch;
        const paginationPags = document.querySelectorAll(".pagination .pagination__pag");
        paginationPags.forEach(pag => {
            const pagNumber = pag.innerHTML;
            pag.addEventListener("click", () => {
                const liveSearchPosition = document.getElementById("input-live-search")
                    .getBoundingClientRect().top;
                let scrollTo;
                if (liveSearchPosition < 0) {
                    scrollTo = window.pageYOffset - Math.abs(liveSearchPosition) - 50
                } else {
                    scrollTo = window.pageYOffset + liveSearchPosition - 50;
                }
                window.scroll({
                    top: scrollTo,
                    behavior: "smooth"
                });
                setTimeout(() => {
                    liveSearchObj.requestComesFromPagination = true;
                    liveSearchObj.paged = pagNumber;
                    liveSearchObj.typingLogic();
                }, 500);
            });
        });
    };
    </script>';
}

echo $paginationResult;
}

?>