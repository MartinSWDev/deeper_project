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

## Project ##
### Tasks ###
- [x] Create a "check-in" class. Simply create class named CheckIn which has properties for the following: Name, rating, review and timestamp.
- [x] Display a form in a popup when clicking on the "Check In" button. When clicking the button, a Bootstrap modal should be displayed. It should have a field for each of the
  properties on the Review class, except the timestamp. The form should submit to the current page, and the submitted check-in data shouldnt appear in the URL.
- [x] Hydrate the check-in class from the form data. Create a new instance of your CheckIn class, and assign the values to it from the submitted data. The
  timestamp will need to store the current date/time upon submission.
- [x] Save all check-in data to a single file. If the file “check-ins.txt” doesn’t exist, your code will need to create it, and should contain a serialised array
  of CheckIn instances.If the file does exist, load all data from it, append your newly hydrated instance to the array, and then
  overwrite the file.
- [x] Display all check-in data on the page.  Using the array of CheckIn instances from the previous task, loop through and display them all on the
  product page.
- [x] Display a success message. Upon a successful submission, display a Bootstrap “success” alert notifying the user that their review was
  successfully saved.
- [x] Add validation to the checkin form.  Add some constraints to the check-in values. Be reasonable in your values, but consider:
  Maximum length for the user’s name
  Making user’s name a required field, and not saving if it’s missing.  Min/max values for ratings. Maximum length for review. Prevent any XSS attempts. Perhaps allow users to use some basic HTML tags, such as strong and em ? If validation fails, show a Bootstrap “danger” alert.