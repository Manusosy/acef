FROM QA: 

The header is transparent and not visible while scrolling unless the background is dark in some parts, work on it to be visible no mater the modes.


No need for the current translation integration, make use of google translation API. Consider adding APIs Page to the admin menu where all kinds of APIs can be configured from the dashboard, starting from the google translate, to payment related APIs like paypal, mpesa.

Speaking of this, the Public donation page is out of touch when it comes to the design and functionality. Stop hardcoding the donation feature but rather intergarate it with several options, having paypal payment collection there that supports card donation will be much better. The donation page in the dashboard too does not make any proper sense. I can't see anything important there other than the design as it lacks any form of functionality. The toggles should only come to life if the donation method has been configured fully and saved.


For admin account settings - Check that it is appearing well in darkmode, also ensure the colors follow the website branding for consistency. For the bottom part on account deletion, have a warning there first before it goes through, and this does not mean when an admin account has been deleted it deletes all the data including project contributions and articles, the articles should automatically move to the next available admin, if none, then the person who wrote the article falls back to the name "ACEF Editorial".


Site Settings

In the dashboard, the site settings where a logo set, the pdfs etc., have the option to click to remove or change, and if removed for instance, the text logo is the automatic fallback.


Programmes Page and Projects Association

The programmes page indicating the number of projects under a certain programs when there aren't projects published yet is quite confusing. capture that so the number of projects under a certain program updates automatically upon selection when adding a new project and publishing it, not just random numbers.

The associated projects to the program will be the ones visible at the bottom area of the individual program if opened by a user.


The Public Gallery Page:

Seems alittle confusing though promising. The categorization of the images by country is something that should be explicitly captured in the admin dashboard too. Or By Project or programme. The filter feature on that page is transparent and seems hardcoded, not showing real connection to the gallery page. Filters also not making any proper sense, no real countries as they are 14 currently. The grid and list functionality should also work as intended and not just for aesthetics. Load more media button should also work in that page, once there is more media in future.

Add a section design for youtube videos at the bottom part where the organizations channel videos can be found and played straight on the platform, and update with the latest video that is posted on youtube. If API is needed, capture it within the dashboard APIs page as directed above, to enable that functionality.


Please remember to remove the "Submit Field Report" button from the gallery page, it makes no sense at all.



About Us- Who we Are

Please have a look at the our journey part, can you animate the part in a way that when the user scrolls either up or down, they are able to see the little green line scroll with them year after year.


For the accreditations page. Ensure that if a logo image is selected, it replaces the text acronyms as they become an automatic fallback for that individual accreditation.



For the Impact Page

At the bottom area of the impact page just before the footer, there are three active projects which appear hardcoded. Correct that to connect and show only the first three projects there once they are added, ensuring that the category is also visible correctly in darkmode too as the design already looks appealing.


Homepage

The news and insghts section on the homepage looks hardcoded, showing three articles but they aren't reflecting what has been published. Correct that to show well with proper category too (green bg for that so it becomes consistently visible in all modes).


Right after the news section there has to be the "Our Global Partners" Carousel for the logos of the partners, slowly sliding across the screen. Can you ensure that carousel is functional by checking the connection with the partners page in the dashboard, As I have see such thing there but no functional button to enable it when adding a new partner.




Security Wise

Anyone can create an account over there, as we enter production, consider adding email verification. A code to be sent via email upon registration to validate the signup. Password strength too, should show when entering password, to avoid weak passwords.
- For the emails, strictly have the accepted email to be the organizational email ending with acef-ngo.org Any other email domain is forbidden. (secret security feature that users shouldn't know, only be told wrong email, and even with a correct email, the get the code for the same first).



Once this is done, we will be set for deployment in cpanel. ssh is the recommended for this for continuous CI/CD in future.





 