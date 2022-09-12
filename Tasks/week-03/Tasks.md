# Week 3 Session 1 #
- [x] Work through all sections of https://www.learn-php.org/en/Welcome
- [x] Create a page which accepts two GET parameters, a and b , and outputs the result when added.
  Your URL should look like maths.php?a=4&b=2
- [x] Update the page from the second exercise to accept a third parameter, operation . This should be
  a string of either “add”, “subtract”, “multiply”, or “divide”. Perform the operation requested, and if the
  submitted operation is not valid, output a messaging which tells the user which options are available.
  e.g.: maths.php?a=4&b=2&operation=multiply
- [x] Create an HTML form, using Bootstrap, which submits to the above page as a GET request. The
  operation should be a dropdown and a and b should be number inputs.
- [x] Instead of navigating to another page, display the output from the previous tasks on the same page
  using an AJAX request through Axios. Display the total in a readonly input field.
- [x] When submitting the above form, serialise the form’s data and store it to a file. The files should be
  named as {timestamp}.txt , for example: 1597421675.txt in the same directory as your
  maths.php script.
- [x] Display a zebra striped bootstrap table of “previous submissions”, with 4 columns: timestamp, value of
  a, operation, value of b.
- [x] When clicking an item in the table, overwrite the values in the form and clear the total, so that the user
  has to submit the form again.