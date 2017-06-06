# SwiftShop

Team Members:

	Shammugam
	Muhammad Syafiq
	Syafida
	Nurul Syafika Khainrina
	Nur Hasnatul Ain 

Project Title: SwiftShop

1. What is the project about?

	SwiftShop is a mobile application that was developed to provide an alternative shopping and checkout process for in-store shopping. The    application makes use of the NFC technology by registering the input saved in the NFC stickers in the store products to be added to the NFC-enabled mobile device. THe input can also be saved using the barcode of the product by using the scanner of the device. Other than that, the application provide the platform for the users to compare prices between visited stores, create a shopping list, as well as to see their past transactions when shopping using the application.
  
2. The module the mobile app has?

	 SwiftShop contains the following modules:

	-Account management: This module allows the user to update their account information after they have regisetred an account for the    application

	-Shopping list management: This module allows the user to create and update their shopping list with information such as the product name nd quantity

	-Payment card management: This module allows the user to manage the payment card information that they register to the application to be used in the checkout.

	-Store catalogue browsing: This module allows the user to browse the catalogue of visited stores and the user can indirectly compare items between stores by changing the store references

	-Shopping cart management: This module allows the user to add items to their shopping cart in the application by scanning the NFC sticker or the barcode of the store product. The user can also update the products quantity and remove them from the cart.

	-Checkout: This module allows the user to checkout their shopping cart at the store by initiating he checkout process and then scanning the tag at the NFC counter in the store.

	-Transaction history: This module allows the user to view their successful transaction history when they checkout using the application.
  
3. What libraries/external API's such as Google API or Firebase API are being used (if any)?

	 The libraries that are used in this application are:
	-Google Volley library (https://github.com/google/volley): used for the transmission of data between the mobile device and the store server.
	-ZXing Android Minimal library (https://github.com/Promptus/zxing-android-minimal): used to add the barcode scanner functionality to the application
  
 4. How to setup the development environment?
 
 - Setting up the mobile application development:
    -Android Studio was used as the Integrated Development Environment (IDE) for this project. The libraries that have been mentioned above have   to be imported into the project by declaring them in the build.gradle file. 
    -An NFC-enabled mobile device was used to test the application during development.
 - Setting up the store server:
    -A store server was setup using a web hosting site to simulate the store database from which the products' information will be retrieved by the application when browsing the store catalogue, adding products to cart and during checkout.
    -The file server details the processing of the information retrieval and sending by the store server which is used by all the stores.
    -The database server details about the catalogue of the store as well as the store information ad other administrative database to be used by the employees of the store on their side.
  
