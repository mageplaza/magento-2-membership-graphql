# Magento 2 Membership GraphQL (Support PWA)

[Mageplaza Membership for Magento 2](https://www.mageplaza.com/magento-2-membership/) is an effective tool to create customer memberships on the online store that increase customer engagement and loyalty. 

With Mageplaza Membership, the store admin can create different membership levels, such as bronze, silver, and gold. The store admin can assign specific products to each level of membership. Customers will be classified into different membership levels based on the products they buy. The assigned products are not limited to any specific type, so it’s flexible for the store owner to draw customers to a certain product that needs to be promoted. 

When customers are members of a membership group, they will have specific privileges or benefits. The benefits are ruled out by store owners from the admin backend, which can be discount coupons or free shipping codes. The store admin can add as many benefits as they want to encourage customers to purchase more to level up their membership, such as from silver to gold. 

Customers can also upgrade their membership level by paying a fixed price for a higher membership package or applying discounts to save money. To motivate customers to take a longer membership time, the store can offer different price levels corresponding to the membership duration. The rule is the longer membership is, the lower the price customers have to pay. For example, for the Gold membership package, $300 for 3 months, $200 for 6 months, and $100 for 12 months. 

It’s easy to customize the membership cards. You can change the feature images, the background of the cards, and add the noticeable labels to attract customers. 

What’s more, **Magento 2 Membership GraphQL is a part of Mageplaza Membership extension that adds GraphQL features.** Mageplaza Magento 2 Membership GraphQL (PWA) supports getting and pushing data on the website with GraphQL, along with PWA compatibility support.

## 1. How to install
Run the following command in Magento 2 root folder:

```
composer require mageplaza/module-membership-graphql
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```
**Note:** 
Magento 2 Membership GraphQL requires installing [Mageplaza Membership](https://www.mageplaza.com/magento-2-membership/) in your Magento installtion. 

## 2. How to use
Mageplaza's Membership GraphQL supports getting Membership Page information, Upgrade Page, Membership products, membership and transaction information of customers, adding membership products to cart, and getting cart information. 

To start working with Membership GraphQL in Magento, complete the following requirements: 
- Use Magento 2.3.x. Return your site to developer mode.  
- Install [chrome extension](https://chrome.google.com/webstore/detail/chromeiql/fkkiamalmpiidkljmicmjfbieiclmeij?hl=en) (currently does not support other browsers)
- Set **GraphQL endpoint** as `http://<magento2-2-server>/graph` in url box. Click on **Set endpoint**. (e.g., `http://develop.mageplaza.com/graphql/ce232/graph). 
- Refer to the GraphQL requests we support [here](https://documenter.getpostman.com/view/10589000/SzS4RSwd?version=latest).

## 3. Devdocs
- [Magento 2 Membership API & examples](https://documenter.getpostman.com/view/10589000/SzS4RSnr?version=latest)
- [Magento 2 Membership GraphQL & examples](https://documenter.getpostman.com/view/10589000/SzS4RSwd?version=latest)

Click on Run in Postman to add these collections to your workspace quickly.

![Magento 2 blog graphql pwa](https://i.imgur.com/lhsXlUR.gif)

## 4. Contribute to this module 
Feel free to **Fork** and contribute to this module. 

You can create a pull request, so we will merge your changes in the main branch. 

## 5. Get support 
- Feel free to [contact us](https://www.mageplaza.com/contact.html) if you have any question. 
- If you find this post helpful, please give it a **Star** ![star](https://i.imgur.com/S8e0ctO.png)


