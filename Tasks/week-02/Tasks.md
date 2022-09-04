# Week 2 Session 1 #
- [x] Read https://javascript.info/ sections 2.1-2.16, 4.1-4.2, 5.1-5.5, 5.9. 5.11-5.12, 9.1, + Part 2 1.2 - 1.8
- [x] Create a single column page with a main title and at least three sections. Each section should have at
  minimum a heading and a block of text (use https://www.lipsum.com/ if you wish to generate blocks of
  text). Include a list at the top containing one link per section which, when clicked, moves the user’s
  window to that section. Include a “Back to the top” link at the bottom.
- [x] Create a form containing a “colour” input. On submission, update the background of the body to the
  entered colour.
- [x] Create a form to facilitate searching for products in a shop. Aim to include fields like keywords,
  category, size, etc.

  
## Project ##
### Tasks ###
- [x] Make the gallery interactive
  - When clicking on one of the thumbnails in the product detail section, the main image should be updated to
    display the image which has been clicked. (already completed last week)


# Week 2 Session 2 #
- [x] Read https://javascript.info/ sections 9.2-9.4, 10.1, 11.1-11.5, 11.8 + Part 2 sections 2.1-2.2, 3.1 - 3.2
- [x] Create a basic page which displays a joke of the day from the Joke of the Day API (https://jokes.one/api/joke/). Instead of using
  XMLHttpRequest like their documentation, use Axios (https://github.com/axios/axios).
- [x] Go back through previous exercises and make them look nicer using Bootstrap - for example, the
  search form from the previous workbook.


## Project ##
### Tasks ###
- [x] Recreate the initial page
  - Create an HTML page which mirrors the design our designer has put together in desktop.png . This
    time, it should use Bootstrap classes. You may still use a static image for the star rating. This time, the page
    must be responsive.
- [ ] Replace the gallery with a Bootstrap carousel
  - The gallery thumbnails are no longer required - simply replace the gallery in the original layout with a
    Bootstrap carousel.
- [x] Implement the mock check-in API (Was provided by course provider, no longer functional)
  - Update the page from the first task to implement the supplied API which provides mock check-in data.
    Instead of hard-coded check-ins, this time you’ll need to display them from the data retrieved via the API. At
    this stage, you may display a number for the rating (ie without the stars).