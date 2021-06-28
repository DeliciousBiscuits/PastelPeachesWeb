// Card Expiry years select options
var start = new Date().getFullYear(); // current year 
var end = 2039; //  date in 10 years
var options = '';
for (var year = start; year <= end; year++) {
  options += '<option value="' + year + '">' + year + '</option>'; // adds html to the year options
}
document.getElementById('year').innerHTML = options;

// Card Expiry years month select options
var start = 1;
var end = 12;
var options = '';
for (var month = start; month <= end; month++) {
  options += '<option value="' + month + '">' + month + '</option>';  // adds html to the month options
}
document.getElementById('month').innerHTML = options;


//
function inputOnFocus(x){
  x.style.background = "#DCDCDC";
}


// onClick to submit the form
function onForm() {
  // variables
  var fname = document.getElementById('fname');
  var phone = document.getElementById('phone');
  var addrs = document.getElementById('addrs');
  var city = document.getElementById('city');
  var state = document.getElementById('state');
  var pcode = document.getElementById('pcode');
  var req = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/; // email requirements for email
  var email = document.getElementById('email');
  var cname = document.getElementById('cname');
  var credcard = document.getElementById('ccred');
  var cardnum = document.getElementById('cnum');
  var ccv = document.getElementById('cvv');
  // variables for the expiry date
  var currdate, exdate;
  var exmonth = document.getElementById('month').value;
  var exyear = document.getElementById('year').value;
  currdate = new Date();
  exdate = new Date();
  exdate.setFullYear(exyear, exmonth, 1); // combines the expiry month and year

  //keeping the div open
    var p = document.getElementById("paypalDiv");
    var c = document.getElementById("cardDiv");
    if (c.style.display === "none") {
         c.style.display = "block";
         p.style.display = "none";
    }
  // validation for the month and year 
  if (exdate < currdate) { // checks if expiry date is past the current date
    document.getElementById('errordate').innerHTML = "Your card is invalid. It's past the expiry date.";// invalid input message
    
  } else {
    document.getElementById('errordate').innerHTML = ' '; // clears out the error message
  
  }

  // validation for the ccv
  if (ccv.value == '') { // checks if the ccv is empty
    document.getElementById('errorccv').innerHTML = 'Please fill out this field.';// missing input message
    ccv.focus(); // focuses on the inputbox
    
  } else if (isNaN(ccv.value)) { // Checks if CCV contains numbers
    document.getElementById('errorccv').innerHTML = 'Please input again. CCV should contain numbers.';// invalid input message
    ccv.focus(); // focuses on the inputbox
  } else if (ccv.value.length > 0 && (ccv.value.length < 3 || ccv.value.length > 3)) { // Checks if CCV has 3 characters
    document.getElementById('errorccv').innerHTML = 'Please input again. CCV should contain 3 digits.';// invalid input message
    ccv.focus(); // focuses on the inputbox
  } else { 
    document.getElementById('errorccv').innerHTML = ' '; // clears out the error message
  }
  
  // validation for the card number
  if (cardnum.value == '') { // checks if card number is empty
    document.getElementById('errorcnum').innerHTML = 'Please fill out this field.';// missing input message
    cardnum.focus(); // focuses on the inputbox
  } else if (isNaN(cardnum.value)) { // Checks if credit card contains numbers
    document.getElementById('errorcnum').innerHTML = 'Please input again. Credit card should contain numbers.';// invalid input message
    cardnum.focus(); // focuses on the inputbox
  } else if (cardnum.value.length > 0 && (cardnum.value.length < 16 || cardnum.value.length > 16)) { // Checks if credit card has 16 characters
    document.getElementById('errorcnum').innerHTML = 'Please input again. Credit card must contain 16 digits.';// invalid input message
    cardnum.focus(); // focuses on the inputbox
  } else {
    document.getElementById('errorcnum').innerHTML = ' '; // clears out the error
  }

  // validation for the card type
  if (credcard.value == 0) { // if the user didnt pick a card type
    document.getElementById('errorcred').innerHTML = 'Please pick a payment type.';// missing input message
    credcard.focus(); // focuses on the inputbox
  } else {
    document.getElementById('errorcred').innerHTML = ' '; // clears the error message
  }
   // validation for the name
   if (cname.value == '') { // checks if it is empty
    document.getElementById('errorcname').innerHTML = 'Please fill out this field.';// missing input message
    cname.focus(); // focuses on the inputbox
  } else { // else field contains values
    document.getElementById('errorcname').innerHTML = ' '; // clears the error message
  }

  // validation for the post code
  if (pcode.value == '') { // checks if the post code is empty
    document.getElementById('errorpcode').innerHTML = 'Please fill out this field.';// missing input message
    pcode.focus(); // focuses on the inputbox
  } else if (isNaN(pcode.value)) { // Checks if CCV contains numbers
    document.getElementById('errorpcode').innerHTML = 'Please input again. This should contain numbers.';// invalid input message
    pcode.focus(); // focuses on the inputbox
  } else if (pcode.value.length > 0 && (pcode.value.length < 4 || pcode.value.length > 4)) { // Checks if Post code has 4 characters
    document.getElementById('errorpcode').innerHTML = 'Please input again. This should contain 4 digits.';// invalid input message
    pcode.focus(); // focuses on the inputbox
  } else {
    document.getElementById('errorpcode').innerHTML = ' '; // clears out the error message
  }
  // validation for the address
  if (state.value == '') { // checks if it's empty
    document.getElementById('errorstate').innerHTML = 'Please fill out this field.';// missing input message
    state.focus(); // focuses on the inputbox
  } else { // else field contains values
    document.getElementById('errorstate').innerHTML = ' '; // clears the error message
  }
  // validation for the address
  if (city.value == '') { // checks if it's empty
    document.getElementById('errorcity').innerHTML = 'Please fill out this field.';// missing input message
    city.focus(); // focuses on the inputbox
  } else { // else field contains values
    document.getElementById('errorcity').innerHTML = ' '; // clears the error message
  }
  // validation for the address
  if (addrs.value == '') { // checks if it's empty
    document.getElementById('erroraddrs').innerHTML = 'Please fill out this field.';// missing input message
    addrs.focus(); // focuses on the inputbox
  } else { // else field contains values
    document.getElementById('erroraddrs').innerHTML = ' '; // clears the error message
  }
   // validation for the email
   if (email.value == '') { // checks if the email is empty
    document.getElementById('erroremail').innerHTML = 'Please fill out this field.';// missing input message
    email.focus(); // focuses on the inputbox
  } else if (req.test(email.value) == false) {
    document.getElementById('erroremail').innerHTML = 'Invalid input. Email needs the character "@" and "."';
    email.focus(); // focuses on the inputbox
    // email length (8 characters)
  } else if (email.value.length < 8 && email.value.length > 0){ 
    document.getElementById('erroremail').innerHTML = 'Please input again. Email must be at least 8 characters.'
    email.focus(); // focuses on the inputbox
  } else { // else field contains values
    document.getElementById('erroremail').innerHTML = ' '; // clears the error message
  }
  // validation for the phone no
  if (phone.value == '') { // checks if the phone no is empty
    document.getElementById('errorphone').innerHTML = 'Please fill out this field.';// missing input message
    phone.focus(); // focuses on the inputbox
  } else if (isNaN(phone.value)) { // Checks if it contains numbers
    document.getElementById('errorphone').innerHTML = 'Please input again. This should contain numbers.';// invalid input message
    phone.focus(); // focuses on the inputbox
  } else if (phone.value.length > 0 && (phone.value.length < 4 || phone.value.length > 4)) { // Checks if Post code has 4 characters
    document.getElementById('errorphone').innerHTML = 'Please input again. This should contain 4 digits.';// invalid input message
    phone.focus(); // focuses on the inputbox
  } else {
    document.getElementById('errorphone').innerHTML = ' '; // clears out the error message
  }
  // validation for the name
  if (fname.value == '') { // checks if it is empty
    document.getElementById('errorfname').innerHTML = 'Please fill out this field.';// missing input message
    fname.focus(); // focuses on the inputbox
  } else { // else field contains values
    document.getElementById('errorfname').innerHTML = ' '; // clears the error message
   
  }

  

}