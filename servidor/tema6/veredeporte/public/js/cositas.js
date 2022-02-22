window.addEventListener("load", function(){

    var toast = document.getElementById("liveToast");

    function toastGone() {
        toast.style.display = "none";
    }

    if(toast != null) {
        this.setTimeout(toastGone,10000);

        document.getElementById("botonToast").addEventListener("click",function() {
            toastGone();
        });
    }

    

});