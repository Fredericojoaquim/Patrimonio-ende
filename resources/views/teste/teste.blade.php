
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   
    <title>Document</title>
</head>
<body>

    <style>

        /* Style the form */
#regForm {
    background-color: #ffffff;
    margin: 100px auto;
    padding: 40px;
    width: 70%;
    min-width: 300px;
  }
  
  /* Style the input fields */
  input {
    padding: 10px;
    width: 100%;
    font-size: 17px;
    font-family: Raleway;
    border: 1px solid #aaaaaa;
  }
  
  /* Mark input boxes that gets an error on validation: */
  input.invalid {
    background-color: #ffdddd;
  }
  
  /* Hide all steps by default: */
  .tab {
    display: none;
  }
  
  /* Make circles that indicate the steps of the form: */
  .step {
    height: 15px;
    width: 15px;
    margin: 0 2px;
    background-color: #bbbbbb;
    border: none;
    border-radius: 50%;
    display: inline-block;
    opacity: 0.5;
  }
  
  /* Mark the active step: */
  .step.active {
    opacity: 1;
  }
  
  /* Mark the steps that are finished and valid: */
  .step.finish {
    background-color: #04AA6D;
  }
    </style>

    




<form id="regForm" action="{{url('/enviar')}}" method="POST">
    @csrf

    <h1>Register:</h1>
    
    <!-- One "tab" for each step in the form: -->
    <div class="tab">Name:
      <p><input placeholder="First name..." name="primeironome" oninput="this.className = ''"></p>
      <p><input placeholder="Last name..." name="ultimonome" oninput="this.className = ''"></p>
    </div>
    
    <div class="tab">Contact Info:
      <p><input placeholder="E-mail..." name="email" oninput="this.className = ''"></p>
      <p><input placeholder="Phone..." name="telefone" oninput="this.className = ''"></p>
    </div>
    
    <div class="tab">Birthday:
      <p><input placeholder="dd" name="dia" oninput="this.className = ''"></p>
      <p><input placeholder="mm" name="mes" oninput="this.className = ''"></p>
      <p><input placeholder="yyyy" name="ano" oninput="this.className = ''"></p>
    </div>
    
    <div class="tab">Login Info:
      <p><input placeholder="Username..." name="username" oninput="this.className = ''"></p>
      <p><input placeholder="Password..." name="senha" oninput="this.className = ''"></p>
    </div>
    
    <div style="overflow:auto;">
      <div style="float:right;">
        <button type="button" id="prevBtn" class="btn btn-secondary" onclick="nextPrev(-1)">Previous</button>
        <button type="button" id="nextBtn" class="btn btn-primary" onclick="nextPrev(1)">Next</button>
      </div>
    </div>
    
    <!-- Circles which indicates the steps of the form: -->
    <div style="text-align:center;margin-top:40px;">
      <span class="step"></span>
      <span class="step"></span>
      <span class="step"></span>
      <span class="step"></span>
    </div>
    
    </form>

<script>
    var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form ...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  // ... and fix the Previous/Next buttons:
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
  // ... and run a function that displays the correct step indicator:
  fixStepIndicator(n)
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
  // if you have reached the end of the form... :
  if (currentTab >= x.length) {
    //...the form gets submitted:
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
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false:
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
  //... and adds the "active" class to the current step:
  x[n].className += " active";
}
</script>


    
</body>
</html>