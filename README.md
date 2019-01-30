# bwt_test

Technical task from GroupBWT - https://www.groupbwt.com/

Task description:
  Parse the weather:
  - create an account on github.com (if not created).
  - create project bwt_test.
  - all changes in the code lead through git.
  - create 4 pages with one entry point.
  - when creating pages, use the Model-view-controller (own implementation, without frameworks).
  page 1 - registration form. Fields: name, surname, email, gender, birthday (gender and birthday - optional fields). 
           Validation must be on the client side and on the server side.
  page 2 - display the weather for today in the city of Zaporozhye (only registered users have access). 
           Data parse on this link http://www.gismeteo.ua/city/daily/5093/
  page 3 - feedback form. fields: name, email, message (all fields are required, validation must be on the client side and on the 
           server side). Also add a captcha.
  page 4 - display the list of feedbacks left on page 3. (only registered users have access)
  - for layout use bootstrap 3 plugin.
  - to parse the weather, you can use the package guzzle (https://github.com/guzzle/guzzle)
  - create an ER-diagram of the structure of the created database. Just put it in git.


Implementation differences from task:
 - I haven't separate page for feedbacks. Instead I show them for authenticated users on every page they can see it.
 - I don't used bootstrap 3 - in order to get more practice with core html and css.
 - I don't use Guzzle. (I got error: 'Fatal error: Uncaught GuzzleHttp\Exception\ConnectException: cURL error 52: Empty reply from server')
   I didn't found workaround for Guzzle, so I used php build in methods. 
   (Literally, I parse HTML and get weather value from there. (I know it is not good))


Other implementation details:
 - To collect weather data you should run weather_app/gismeteo_parser.php independently.
 - Also change project settings in 'settings.php' accordingly to your environ and needs


Used software:
 - php  - 7.2.12
 - xampp - 7.2.12
 - MySQL - 5.5.60


Followed standards:
 - PSR-2 for PHP
 - BEM for HTML and CSS
