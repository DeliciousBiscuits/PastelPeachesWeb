-- MySQL Workbench Forward Engineering
SET
    @OLD_UNIQUE_CHECKS = @@UNIQUE_CHECKS,
    UNIQUE_CHECKS = 0;
SET
    @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS,
    FOREIGN_KEY_CHECKS = 0;
SET
    @OLD_SQL_MODE = @@SQL_MODE,
    SQL_MODE = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';


-- -----------------------------------------------------
-- Table `peachesdb`.`customer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `customer`(
    `customerId` INT(6) NOT NULL AUTO_INCREMENT,
    `firstName` VARCHAR(60) NULL,
    `lastName` VARCHAR(60) NULL,
    `userName` VARCHAR(30) NOT NULL,
    `password` CHAR(200) NOT NULL,
    `email` VARCHAR(80) NOT NULL,
    `phone` INT NULL,
    PRIMARY KEY(`customerId`)

);
-- -----------------------------------------------------
-- Table `peachesdb`.`address`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `address`(
    `addressId` INT(6) NOT NULL AUTO_INCREMENT,
    `customerId` INT(6) NOT NULL,
    `lineOne` VARCHAR(80) NULL,
    `lineTwo` VARCHAR(80) NULL,
    `postcode` INT NULL,
    `city` VARCHAR(60) NULL,
    `state/territory` VARCHAR(60) NULL,
    PRIMARY KEY(`addressId`),
    INDEX `fk_address_customer1_idx`(`customerId` ASC),
    CONSTRAINT `fk_address_customer1` FOREIGN KEY (`customerId`) REFERENCES `customer`(`customerId`) ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- -----------------------------------------------------
-- Table `peachesdb`.`category`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `category`(
    `categoryId` INT(6) NOT NULL AUTO_INCREMENT,
    `categoryName` VARCHAR(60) NULL,
    `details` VARCHAR(280) NULL,
    PRIMARY KEY(`categoryId`)
);
-- -----------------------------------------------------
-- Table `peachesdb`.`product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `product`(
    `productId` INT(6) NOT NULL AUTO_INCREMENT,
    `categoryId` INT(6) NOT NULL,
    `productName` VARCHAR(60) NULL,
    `description` VARCHAR(280) NULL,
    `image` VARCHAR(100) NULL,
    `price` DOUBLE NULL,
    `status` ENUM(
        'Available',
        'Out of stock',
        'Unavailable'
    ) NOT NULL,
    PRIMARY KEY(`productId`),
    INDEX `fk_product_category1_idx`(`categoryId` ASC),
    CONSTRAINT `fk_product_category1` FOREIGN KEY(`categoryId`) REFERENCES `category`(`categoryId`) ON DELETE NO ACTION ON UPDATE NO ACTION
);
-- -----------------------------------------------------
-- Table `peachesdb`.`shoppingCart`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shoppingCart`(
    `cartId` INT(11) NOT NULL AUTO_INCREMENT,
    `customerId` INT(6) NOT NULL,
    `cartTotal` DOUBLE NULL,
    `quantity` INT NULL,
    PRIMARY KEY(`cartId`),
    INDEX `fk_cart_customer1_idx`(`customerId` ASC),
    CONSTRAINT `fk_cart_customer1` FOREIGN KEY(`customerId`) REFERENCES `customer`(`customerId`) ON DELETE NO ACTION ON UPDATE NO ACTION
);
-- -----------------------------------------------------
-- Table `peachesdb`.`shipping`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shipping`(
    `shippingId` INT(11) NOT NULL,
    `shippingCost` DOUBLE NULL,
    PRIMARY KEY(`shippingId`)
);
-- -----------------------------------------------------
-- Table `peachesdb`.`order`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `order`(
    `orderId` INT(11) NOT NULL AUTO_INCREMENT,
    `customerId` INT(6) NOT NULL,
    `addressId` INT(6) NOT NULL,
    `shippingId` INT(11) NOT NULL,
    `dateCreated` DATE NULL,
    `dateShipped` DATE NULL,
    `status` ENUM(
        'New',
        'Hold',
        'Shipped',
        'Delivered',
        'Closed'
    ) NULL,
    `orderTotal` DOUBLE NULL,
    PRIMARY KEY(`orderId`),
    INDEX `fk_order_customer1_idx`(`customerId` ASC),
    INDEX `fk_order_shipping1_idx`(`shippingId` ASC),
    INDEX `fk_order_address1_idx`(`addressId` ASC),
    CONSTRAINT `fk_order_customer1` FOREIGN KEY(`customerId`) REFERENCES `customer`(`customerId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT `fk_order_shipping1` FOREIGN KEY(`shippingId`) REFERENCES `shipping`(`shippingId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT `fk_order_address1` FOREIGN KEY(`addressId`) REFERENCES `address`(`addressId`) ON DELETE NO ACTION ON UPDATE NO ACTION
);
-- -----------------------------------------------------
-- Table `peachesdb`.`cartItem`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cartItem`(
    `cartId` INT(11) NOT NULL,
    `itemId` INT(6) NOT NULL,
    `orderId` INT(11) NOT NULL,
    `itemName` VARCHAR(60) NULL,
    `quantity` INT NULL,
    `unitCost` DOUBLE NULL,
    `subtotal` DOUBLE NULL,
    INDEX `fk_cartItem_cart1_idx`(`cartId` ASC),
    INDEX `fk_cartItem_product1_idx`(`itemId` ASC),
    PRIMARY KEY(`cartId`, `itemId`),
    CONSTRAINT `fk_cartItem_cart1` FOREIGN KEY(`cartId`) REFERENCES `shoppingCart`(`cartId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT `fk_cartItem_product1` FOREIGN KEY(`itemId`) REFERENCES `product`(`productId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT `fk_cartItem_order1` FOREIGN KEY(`orderId`) REFERENCES `order`(`orderId`) ON DELETE NO ACTION ON UPDATE NO ACTION
);
-- -----------------------------------------------------
-- Table `peachesdb`.`payment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `payment`(
    `paymentId` INT NOT NULL AUTO_INCREMENT,
    `customerId` INT(6) NOT NULL,
    `orderId` INT(11) NOT NULL,
    `paymentPaid` DATE NULL,
    `paymentTotal` DOUBLE NULL,
    `Details` VARCHAR(280) NULL,
    `Method` VARCHAR(45) NULL,
    PRIMARY KEY(`paymentId`),
    INDEX `fk_payment_customer1_idx`(`customerId` ASC),
    INDEX `fk_payment_order1_idx`(`orderId` ASC),
    CONSTRAINT `fk_payment_customer1` FOREIGN KEY(`customerId`) REFERENCES `customer`(`customerId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT `fk_payment_order1` FOREIGN KEY(`orderId`) REFERENCES `order`(`orderId`) ON DELETE NO ACTION ON UPDATE NO ACTION
);
SET
    SQL_MODE = @OLD_SQL_MODE;
SET
    FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS;
SET
    UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS;


-- note: change image to just the image name and file type without the path
-- -----------------------------------------------------
-- Table `peachesdb`.`category`
-- -----------------------------------------------------
insert into `category`(`categoryId`,`categoryName`,`details`) values 
(01,'Earrings','We commit ourselves to stellar ears'),
(02,'Necklaces','Things go better with necklaces'),
(03,'Rings','Great Rings. Great times'),
(04,'Choker',"There's First love, and There's Choker love"),
(05,'Glasses','Designed to see yourself in style'),
(06,'Hats','We believe in fine hats'),
(07,'Bags','The smart choice for bag lovers'),
(08,'Novelty Gifts','Novelty: Love it or Leave it');
-- -----------------------------------------------------
-- Table `peachesdb`.`product` EARRINGS
-- -----------------------------------------------------
insert into `product`(`categoryId`,`productName`,`description`,`image`,`price`,`status`) values 
(01,'Laurel Gold Earring','Proclaim victory with some gold laurels','../images/eargldlrl.jpg',49.99,'Available'),
(01,'Heart Gold Earrings','Gotta love these hearts','../images/eargldhrt.jpg',49.99,'Available'),
(01,'Cherry Bomb Earrings','If Red and Tasty is your personality','../images/eargldhrt.jpg',49.99,'Available');

-- -----------------------------------------------------
-- Table `peachesdb`.`product` NECKLACES
-- -----------------------------------------------------
insert into `product`(`categoryId`,`productName`,`description`,`image`,`price`,`status`) values 
(02,'Starry Night Necklace','Look beautiful as a Van Gogh Painting','../images/ncklcsstrrynght.jpg',41.00,'Available'),
(02,'Rosy Gold Necklace','Flaunt that shiny rose','../images/ncklcsgldrs.jpg',39.99,'Available'),
(02,'Starry Rosegold Necklace','Shine bright like a star in the night','../images/ncklcsstrry.jpg',39.99,'Available');

-- -----------------------------------------------------
-- Table `peachesdb`.`product` RINGS
-- -----------------------------------------------------
insert into `product`(`categoryId`,`productName`,`description`,`image`,`price`,`status`) values 
(03,'Starry constellation rings set','As they say, Reach for the stars','../images/rngstrrycnslltn.jpg',24.00,'Available'),
(03,'Alphabet rings set','Complete 26 Gold alphabets for your hands','../images/rnglphbt.jpg',26.00,'Available'),
(03,'Skinny Stacking Silver rings set','Stack them on your fingers duh','../images/rngsstckslvr.jpg',19.00,'Available');

-- -----------------------------------------------------
-- Table `peachesdb`.`product` CHOKER
-- -----------------------------------------------------
insert into `product`(`categoryId`,`productName`,`description`,`image`,`price`,`status`) values 
(04,'Hearty Chokers','Show some love around your neck','../images/chkrhrts.jpg',15.00,'Available'),
(04,'Rose Gold Rosy Choker','This store really loves their roses','../images/chkrrsy.jpg',20.00,'Available'),
(04,'Linked Hearts Choker','These are basically cute','../images/chkrlnkdhrts.jpg',23.00,'Available');
-- -----------------------------------------------------
-- Table `peachesdb`.`product` GLASSES
-- -----------------------------------------------------
insert into `product`(`categoryId`,`productName`,`description`,`image`,`price`,`status`) values 
(05,'Jet Black Heart Shades','Look edgy with hearts','../images/glshrtshds.jpg',20.00,'Available'),
(05,'Pink vintage Glasses','Fall in Love through these babies','../images/glspnkvntg.jpg',18.00,'Available'),
(05,'Simple and Classic Glasses','Simple is the new cute','../images/glssmpl.jpg',15.00,'Available'),
(05,'Classic Transparent Glasses','Never goes out of style!','../images/glssmpltrnsprnt.jpg',15.00,'Available'),
(05,'Round Orange Shades','Looking sexy and zesty','../images/glsrndrng.jpg',18.00,'Available'),
(05,'Floral decor Glasses','Bring out that cute lolita energy','../images/glsflwrs.jpg',20.00,'Available');
-- -----------------------------------------------------
-- Table `peachesdb`.`product` HATS
-- -----------------------------------------------------
insert into `product`(`categoryId`,`productName`,`description`,`image`,`price`,`status`) values 
(06,'Rose Cap','Maybe you like roses?','../images/htsblckrsyflrls.jpg',25.00,'Available'),
(06,'Senpai Cap','Call me "Senpai".','../images/htsblcksnp.jpg',25.00,'Available'), 
(06,'Pink Florals Cap','If you love pink and flowers, yeah.','../images/htswhtpnkflrls.jpg',29.99,'Available');

-- -----------------------------------------------------
-- Table `peachesdb`.`product` BAGS
-- -----------------------------------------------------
insert into `product`(`categoryId`,`productName`,`description`,`image`,`price`,`status`) values 
(07,'Strawberry Pencil bags','A cute baggie for your pens','../images/bgstrwbrrypncl.jpg',20.00,'Available'),
(07,'Embroided Fruits Backpacks','Fruity Cutie Backpacks','../images/bgfrtsbckpck.jpg',39.99,'Available'), 
(07,'White Rosy Backpack','Do you like roses?','../images/bgwhtrsybckpck.jpg',39.99,'Available'), 
(07,'Orange Fanta backpack','Proclaim your love for zesty orange soda','../images/bgrngfntbckpck.jpg',29.99,'Available'), 
(07,'Pink Pocky backpack','Proclaim your love for sweet bread sticks','../images/bgpnkpckybckpck.jpg',29.99,'Available'), 
(07,'Mini Plush bunny backpack',"Who doesn't adore this cutie right here?",'../images/bgmnplshbnnybckpck.jpg',31.99,'Out of Stock');
-- -----------------------------------------------------
-- Table `peachesdb`.`product` NOVELTY GIFTS
-- -----------------------------------------------------
insert into `product`(`categoryId`,`productName`,`description`,`image`,`price`,`status`) values 
(08,'Peach Milk Pin','Pin with a Peach','../images/nvltyfrtypns.jpg',5.00,'Available'),
(08,'Peach Patches','Patch with a Peach','../images/nvltypchptchs.jpg',5.00,'Available'), 
(08,'Peach Squishy','Squish with a Peach','../images/nvltypchsqshy.jpg',9.99,'Available');
/*
INSERT INTO `tblproduct` (`id`, `name`, `code`, `image`, `price`) VALUES
(1, 'FinePix Pro2 3D Camera', '3DcAM01', 'product-images/camera.jpg', 1500.00),
(2, 'EXP Portable Hard Drive', 'USB02', 'product-images/external-hard-drive.jpg', 800.00),
(3, 'Luxury Ultra thin Wrist Watch', 'wristWear03', 'product-images/watch.jpg', 300.00),
(4, 'XP 1155 Intel Core Laptop', 'LPN45', 'product-images/laptop.jpg', 800.00);

*/