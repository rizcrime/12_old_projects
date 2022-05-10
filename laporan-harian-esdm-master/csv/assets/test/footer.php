<div id="f">
    <div class="container">
      <div class="row">
        <p>Alamat : Jl. Prof. DR. Soepomo No.10, RT.1/RW.3,<br>
        Menteng Dalam, Tebet, Kota Jakarta Selatan,<br>
        Daerah Khusus Ibukota Jakarta 16870<br>
        Phone: (021) 8307514 Propinsi: Jakarta</p>
    </div>
</div>
</div>

<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/bolt/assets/js/bootstrap.js"></script>
</body>


<script type="text/javascript">
//Function Sign Up
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the crurrent tab

function showTab(n) {
    // This function will display the specified tab of the form...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    //... and fix the Previous/Next buttons:
    if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Submit";
    } else {
        document.getElementById("nextBtn").innerHTML = "Next";
    }
    //... and run a function that will display the correct step indicator:
    fixStepIndicator(n);
}

function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form...
    if (currentTab >= x.length) {
        // ... the form gets submitted:
        document.getElementById("regForm").submit();
        return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
}

function validateForm() {
    // This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    // A loop that checks every input field in the current tab:
    for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "" && y[i].type!='file') {
            // add an "invalid" class to the field:
            y[i].className += " invalid";
            // and set the current valid status to false
            valid = false;
        }
    }
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid; // return the valid status
}

function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class on the current step:
    x[n].className += " active";
}        

//Function Company Type
jQuery(function($){
    $('#tipe1').hide();
    $('#tipe2').hide();

    $('#tipe').change(function(){
        if($('#tipe').val() == '1'){
            $('#tipe1').show();
            $('#tipe2').hide();
        }
        else if($('#tipe').val() == '2'){
            $('#tipe1').hide();
            $('#tipe2').show();
        }
    })
})

//Function Block
var arrayapagitu = [];

function f_showBlock(obj) {
    if(obj.checked){
        $("#blockSpan"+obj.value).attr("style","display:block");  
    }else{
        $("#blockSpan"+obj.value).attr("style","display:none");
    }
}

//Function Total Payment
function f_save(obj,blockValue) {
    if(obj.checked){
        arrayapagitu.push(obj.value);
    }else{
        arrayapagitu.splice(arrayapagitu.indexOf(obj.value),1); 
    }
    
    $("#payment").val(arrayapagitu.length * Number(blockValue));
}

// Modal Sign In
var modal = document.getElementById('id01');
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
