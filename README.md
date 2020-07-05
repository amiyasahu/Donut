# Donut Theme

Modern and Responsive theme for [Question2Answer ( Q2A )](https://www.question2answer.org/) which is made for great readability and awesome user experience.

##### Screenshot

[![Donut theme](https://user-images.githubusercontent.com/2969035/44949562-470cf800-ae02-11e8-87cf-45072b4a88b1.png)](https://github.com/amiyasahu/Donut)

## Description
[Donut theme][] is a free and open-source **responsive Question2Answer theme** designed for great readability with a clean interface powered by [Bootstrap](http://getbootstrap.com/). 
It comes with an admin panel with bunch of options that lets you change nearly every aspect of the theme and customize your website.

[Change log](https://github.com/amiyasahu/Donut/blob/master/CHANGELOG.md)

## Features

* Mobile first, clean content focused, responsive layout designed for redability
* Easy to install, setup, customize
* Powered by [Bootstrap](http://getbootstrap.com/)
* Made with [less](http://lesscss.org/) (less files included with source code)
* Flexible theme with a admin panel settings 
* Inbuilt CDN support and minified assets which loads your website faster and consumes less site resources
* Theme settings in admin panel for better customization
* Better integration with the [Breadcrumbs plugin](https://github.com/amiyasahu/q2a-breadcrumbs) 
* Better integration with the [Onsite notifications plugin](https://github.com/q2apro/q2apro-on-site-notifications/) 
* Better integration with the [Open login plugin](https://github.com/alixandru/q2a-open-login)
* Developer friendly
* Multilingual support


## Installation

1. [Install Question2Answer][]. This theme requires version 1.7 or later (see the [change log][] for details)   
2. [Download the latest version][latest release] of theme from GitHub, either using [Git][], or downloading directly:
     
     - **Note :** The master branch may have some broken parts, so it is recomended to download the released versions from the releases page and latest release is prefered. 
     - To download using git, install git and then type 
     
          `git clone https://github.com/amiyasahu/Donut.git` 

          `git checkout tags/<latest_tagged_version>`
          
     - To download directly, go to the [latest release][latest release] page and click **Source code** in the **Downloads** section
     
3. Copy the [Donut-admin][Plugin folder] folder to `qa-plugin` directory of your q2a installation (eg. `qa-plugin/Donut-admin`) 
4. Copy the [Donut-theme][Theme folder] folder to `qa-theme` directory of your q2a installation (eg. `qa-theme/Donut-theme`)
5. If your site language is other than English, Copy the appropriate language files from [here][Donut lang] to `qa-plugin/Donut-admin/lang` directory
5. Visit `http://your-q2a-site.com/admin/donut-theme/general-settings` for configuring the theme as per your taste 
6. Visit `http://your-q2a-site.com/admin/general` , select the `Donut` for both the `Site theme` and `Theme for mobile`
7. Congratulations, Donut theme is now up and running on your website :smile:

## Contribution guidelines

* Fork the [repositary][] and make improvements. Feel free to send a Pull requests
* If you are contributing language files then please send pull request to [this repository][Donut lang]. Since Donut 2.0, this repository only will host default language files
* Help me in testing the theme and finding the bugs 
* Report [bugs][] here if you find any 
* Review the code if you are a developer who loves q2a platform
* Star the repository which is very encouraging 
* Help me writing a better software 
* Tell your friends about Q2A (and Donut theme :smile:) and help Q2A growing 

## Author

This free theme is created with :heart: by [Amiya Sahu](http://amiyasahu.github.io) and [contributors](https://github.com/amiyasahu/Donut/graphs/contributors)

## Credits

* [Bootstrap](http://getbootstrap.com/)
* [FontAwesome](http://fortawesome.github.io/Font-Awesome/) for cool icons
* [BootstrapCDN](http://www.bootstrapcdn.com/) for providing free CDN for Bootstrap and FontAwesome
* [Freepik.com](http://www.freepik.com/) for the awesome vectors

## License
This program is free software; you can redistribute it and/or modify it under the terms of the [GNU General Public License](https://github.com/amiyasahu/Donut/blob/master/LICENSE) as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.

## Disclaimer
This code has not been extensively tested on high-traffic installations of Q2A. You should perform your own tests before using this plugin on a live (production) environment. 

## About Question2Answer
**Question2Answer** is a free and open source PHP and MySQL based platform for creating Question & Answer sites. For more information visit Q2A's official site at [question2answer.org](http://www.question2answer.org/)

  [Question2Answer]: http://www.question2answer.org/
  [Install Question2Answer]: http://www.question2answer.org/install.php
  [Git]: http://git-scm.com/
  [Donut theme]: https://github.com/amiyasahu/Donut
  [Donut lang]: https://github.com/amiyasahu/Donut-language-files
  [change log]: https://github.com/amiyasahu/Donut/blob/master/CHANGELOG.md
  [GitHub]: https://github.com/amiyasahu/Donut
  [Theme folder]: https://github.com/amiyasahu/Donut/tree/master/qa-theme/Donut-theme
  [Plugin folder]: https://github.com/amiyasahu/Donut/tree/master/qa-plugin/Donut-admin
  [repositary]: https://github.com/amiyasahu/Donut
  [latest release]: https://github.com/amiyasahu/Donut/releases/latest
  [bugs]: https://github.com/amiyasahu/Donut/issues
