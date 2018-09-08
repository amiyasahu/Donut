# Change Log

## Version 2.0 (Latest stable version)

* Improved wordpress integration. Now displays login and register links in the drop-down when the user is not logged in
* Fixed PHP warning message (issue #86)
* Fixed Issues while adding new sections to profile. (issue #66)
* Fix the favorites page under user profile (issue #68)
* Fixed Rendering for voting button
* Dropped badge output from the users page, this should be taken care by the badge plugin
* Fixed message on tags page when there are no tags available (issue #74)
* Moved other language files to separate Github Repo
* Removed deprecated options framework
* Bootstrap URL https issue (issue #70)
* Fixed micro-data issue for up-vote count (issue #61)
* Compressed header image, saves 81% resource utilization. Page loads faster
* Conversion text from banner's "ask" field to bundle properties (thanks to @edermfl for PR #64)
* Dropped loading of qa-styles.css as it was not having any styling
* Removed few unused methods, add some minor fixes and code improvements
* Fixed the issue with homepage detection

## Version 1.6.3

* Used Open-sans font for better readability 
* Used local font for supporting both http and https

## Version 1.6.2

* Fixed issue in related questions widget in questions bottom [issue #33](https://github.com/amiyasahu/Donut/issues/33)
* Fixed issue in users page when default avatar is not set [issue #34](https://github.com/amiyasahu/Donut/issues/34)
* Improved back to top button
* Fixed duplicate border bottoms if the answer form does not exists 
* Fixed the compatibility of official facebook login plugin [#35](https://github.com/amiyasahu/Donut/issues/35)
* Fixed 404 page issue 

## Version 1.6.1

* Added custom 404 page
* Added update uri to check for the updates of the theme
* Added installation instructions 
* Fixed a minor bug for the admin panel page 

## Version 1.6

* Added new Donut Admin plugin 
* Added Admin page settings for Donut theme 
* Added settings link for user dropdown navigation (Only visible for Admin ans Super Admin)
* All theme options can be set / reset from admin panel 
* Several CSS bug fixes 
* Bug fix for answer selection on tablets 
* Added minified donut.css file for the prod mode 
* Offset fix for the navigation bar 
* Fix for action buttons dropdown 
* Fixed overflow of search box in chrome 
* Fixed hidden questions page 
* Added cache boosting for the newer css and JS files 
* Support for multiple languages

## Version 1.5

* Several minor CSS bug fixes 
* Fixed view count overlaps when error is shown on question page
* Fixed badge plugin integration on profile page 
* Fixed text overlap for the profile page 
* Improved profile page layout 
* Improved tags page layout 
* Fixed tags page layout  
* Fixed users page layout
* Improved layout for the wall posts and messages 
* Fixed RSS widget 
* Fixed positioning RSS and the favorite button 
* Improved question title 
* Improved comments layout 
* Changed icons for login and logout 
* Fixed flicker issue when the page size is smaller (http://stackoverflow.com/a/32110545)
* [Fixed](https://github.com/amiyasahu/Donut/pull/27) the search bar padding issue for FF (Thanks to [Hamza Yusuf Çakır](https://github.com/hckrtech))
* Updated Ask button icon 
* Added IP block and unblock icons 

## Version 1.4

* Bootstrap updated to 3.3 and FontAwesome updated to 4.2.0
* Major LESS refractoring for saving KBs in the generated CSS file
* Full compactibility with q2a 1.7
* [Fixed](https://github.com/amiyasahu/Donut/pull/21) wordpress integration (Thanks to [Fabio Brunelli](https://github.com/arioch1984))
* More light CSS than the previous versions 
* File based customization options 
* Improved color scheme 
* Improved the question and answer list layout 
* Added top bar above the main navigation bar (Can be hidden from option settings)
* Completely rewritten main navigation bar 
* Fixed navigation bar (Can be configured from option settings)
* The search box on the header moved to sidebar and for mobile devices on the top of every page 
* Added website header for the home page 
* Allow users to close the home page banner 
* New elegant footer design 
* Added social settings for the topbar and the footer 
* Added new `Ask box` for home page 
* Better integration with the [Breadcrumbs plugin](https://github.com/amiyasahu/q2a-breadcrumbs) 
* Better integration with the [Onsite notifications plugin](https://github.com/q2apro/q2apro-on-site-notifications/) 
* On question page the extra buttons collapses to a single action button (configurable from the option settings)
* Added site stats above the footer 
* Added back to top button 
* Added support to show the copyright text at the footer 
* Updated tag element for better stability 
* Styled default q2a `Ask box`
* Fixed blocked users page 
* Fixed Separate vote buttons 
* Updated attribution of the Donut theme 
* Fixed [#22](https://github.com/amiyasahu/Donut/issues/22)
* Fixed [#23](https://github.com/amiyasahu/Donut/issues/23)
* Fixed Admin buttons issue 
* Fixed tool tips issue on the voting buttons 
* Added style for disabled voting buttons 
* Updated sidebar layout 
* Updated navbar for non loggedin users
* Fixed responsive navigation bar 
* Improved `Answer form`
* Added Closable error boxes 
* Updated for errors when ajax response
* Added private message link in the user dropdown navigation 

## Version 1.3

* CSS bug fixes 
* Added template files 


## Version 1.2
* several bug fixes 
* Improved CSS 
* Improved nav bar 
* Improved navbar for mobile devices 
* Better integration with the [Open login plugin](https://github.com/alixandru/q2a-open-login) 

## Version 1.1

* Several minor CSS bug fixes 

## Version 1.0
* Initial version 
* Responsive layout 
* Powered by [Bootstrap](http://getbootstrap.com/) 
* LESS files for generating CSS 
* Icons provided by [FontAwesome] (http://fortawesome.github.io/Font-Awesome)
* Nice question page view 
* Nice profile page view 
* Inbuilt CDN support for the bootstrap and fontAwesome libraries for faster loading 
