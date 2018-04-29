# Custom Calculator


This specification describes creating a Custom Calculator.
This custom calculator will perform various calculations based on an e-commerce premise.

A form will take quantity, price, tax rate, shipping cost, and discount values, and the PHP script that handles the form will return a total cost.
That cost will also be broken down by the number of payments the user wants to make in order to generate a monthly cost value (EMI).

Following steps have been performed to implement this:

## 1. A HTML form is created.

A file with name as calculator.html is created. The form have the following view:

![calc1](https://user-images.githubusercontent.com/19959305/39407788-7cb383c8-4be9-11e8-9ec2-f435f852dbf4.JPG)


This form takes numbers from the user and sends (using POST method) them to the PHP page.

There are four shipping methods. The shipping selection is done using a drop-down menu.
The value of the selected option is the cost for that option.
The tax rate should be entered as percentage.

The final input types take a number for how many payments are required and then create a submit button (labeled

## 2. PHP Script
As second step, created PHP script that performs all the standard mathematical calculations using the numbers submitted from the HTML form.

The output form when user hits the submit button:


![calc2](https://user-images.githubusercontent.com/19959305/39407821-0fd22470-4bea-11e8-83f7-1a2c68c4b7cb.JPG)

## 3. About Page
Application includes an About page (about.html), clearly linked from the main page. This page includes following sections:

Overview: A description of what the web application is, what problem it is solving or what service it is providing.
This is a narrative description (meaning not bullet points) of the requirements for the application, usually created by or in consultation with the customer for whom you're developing the webapp.

This application is responsive in design and use Bootstrap to implement the same.
