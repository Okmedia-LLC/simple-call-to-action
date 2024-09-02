# Simple Call to Action OpenCart Module

## Overview
The Simple Call to Action OpenCart Module is a custom add-on designed for the OpenCart e-commerce platform. This module allows administrators to create and display customizable call-to-action sections on their storefront, helping to drive user engagement and conversions. You can configure the message, button text, link, and style to match your website's branding and objectives.

## Features
- **Customizable Call to Action:** Easily create and customize call-to-action sections with your preferred message, button text, and links.
- **Flexible Placement:** Add the call-to-action to any section of your site, such as the homepage, product pages, or checkout page.
- **Admin Interface:** User-friendly interface integrated within the OpenCart admin panel for managing call-to-action sections.
- **Compatibility:** Designed to work seamlessly with OpenCart 4.x and higher versions.

## MVC Architecture
The Simple Call to Action OpenCart Module is developed using the MVC (Model-View-Controller) architecture, which organizes the codebase into three interconnected components:

- **Model:** Manages the data logic, handling the retrieval and manipulation of data related to call-to-action sections.
- **View:** Handles the user interface, ensuring that the call-to-action sections are presented correctly in the OpenCart admin panel and on the storefront.
- **Controller:** Facilitates the interaction between the Model and View, processing user inputs and updating the Model and View as necessary.

This architecture ensures a clean separation of concerns, making the module easier to maintain, extend, and test.

## Installation

1. **Upload the Module:**
   - Upload the `simple_call_to_action.ocmod.zip` file via the OpenCart Extension Installer.
   - Go to `Extensions > Modifications` and click on the `Refresh` button to apply the changes.

2. **Enable the Module:**
   - Navigate to `Extensions > Extensions > Modules`.
   - Find the `Simple Call to Action` module in the list and click `Install`.
   - Once installed, click `Edit` to configure the module settings.

## Usage

1. **Activate the Module:**
   - After installing the module, go to `Extensions > Extensions > Modules`.
   - Find the `Simple Call to Action` module and click `Install`.
   - Once installed, click `Edit` to configure the module settings.

2. **Create a Call-to-Action:**
   - After enabling the module, navigate to the module settings and create a new call-to-action section with your desired message, button text, and link.

3. **Add to Layout:**
   - To display the call-to-action on a specific page (e.g., homepage, checkout), navigate to `Design > Layouts` in the admin panel.
   - Select the page where you want to display the call-to-action.
   - Add the call-to-action module to the desired layout position (e.g., content top, content bottom, etc.).

## Requirements
- OpenCart Version 4.x or higher
- PHP 7.1 or higher

## Uninstallation
To remove the module, navigate to `Extensions > Extensions > Modules`, find `Simple Call to Action`, and click `Uninstall`. This will remove the module and all associated data from your OpenCart store.

## License
This module is proprietary and is intended for internal use within the company. Redistribution or use outside the company is prohibited.

## Author
**Ehmedli Ehmed** - Okmedia MMC
