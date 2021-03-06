-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2022 at 09:18 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pe_tpl`
--

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` int(11) NOT NULL,
  `email_type` varchar(100) DEFAULT NULL,
  `email_subject` varchar(100) DEFAULT NULL,
  `email_header` varchar(100) DEFAULT NULL,
  `email_summary` varchar(255) DEFAULT NULL,
  `email_body` text DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `mod_date` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `email_type`, `email_subject`, `email_header`, `email_summary`, `email_body`, `date`, `mod_date`) VALUES
(2, 'mailing', 'Message', 'Message', '', '{{message}}', NULL, NULL),
(3, 'subscribe', 'Subscription', 'Subscription', 'Summary', '&lt;p&gt;Hello, {{user_name}}! Thank you for subscribing to {{sitename}}&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;https://localhost/php-email/uploads/images/2021/05/image-1621856379-yhtOGgyke0DSNFWA5yrC.jpg&quot; style=&quot;width: 25%;&quot;&gt;&lt;br&gt;&lt;/p&gt;', '1621856385', '1622061645');

-- --------------------------------------------------------

--
-- Table structure for table `email_themes`
--

CREATE TABLE `email_themes` (
  `id` int(11) NOT NULL,
  `theme_name` varchar(100) DEFAULT NULL,
  `theme_header` longtext DEFAULT NULL,
  `theme_body` longtext DEFAULT NULL,
  `theme_footer` longtext DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `mod_date` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_themes`
--

INSERT INTO `email_themes` (`id`, `theme_name`, `theme_header`, `theme_body`, `theme_footer`, `date`, `mod_date`) VALUES
(1, 'Default Theme', '    \r\n        &lt;meta charset=&quot;utf-8&quot;&gt;\r\n        &lt;meta name=&quot;viewport&quot; content=&quot;width=device-width, initial-scale=1, shrink-to-fit=no&quot;&gt;\r\n        &lt;meta name=&quot;x-apple-disable-message-reformatting&quot;&gt;\r\n        &lt;meta http-equiv=&quot;X-UA-Compatible&quot; content=&quot;IE=edge&quot;&gt;\r\n        &lt;title&gt;{{email_subject}}&lt;/title&gt;\r\n        &lt;style type=&quot;text/css&quot;&gt;\r\n            a {\r\n                text-decoration: none;\r\n                outline: none;\r\n            }\r\n            @media (max-width: 649px) {\r\n                .o_col-full {\r\n                    max-width: 100% !important;\r\n                }\r\n                .o_col-half {\r\n                    max-width: 50% !important;\r\n                }\r\n                .o_hide-lg {\r\n                    display: inline-block !important;\r\n                    font-size: inherit !important;\r\n                    max-height: none !important;\r\n                    line-height: inherit !important;\r\n                    overflow: visible !important;\r\n                    width: auto !important;\r\n                    visibility: visible !important;\r\n                }\r\n                .o_hide-xs,\r\n                .o_hide-xs.o_col_i {\r\n                    display: none !important;\r\n                    font-size: 0 !important;\r\n                    max-height: 0 !important;\r\n                    width: 0 !important;\r\n                    line-height: 0 !important;\r\n                    overflow: hidden !important;\r\n                    visibility: hidden !important;\r\n                    height: 0 !important;\r\n                }\r\n                .o_xs-center {\r\n                    text-align: center !important;\r\n                }\r\n                .o_xs-left {\r\n                    text-align: left !important;\r\n                }\r\n                .o_xs-right {\r\n                    text-align: left !important;\r\n                }\r\n                table.o_xs-left {\r\n                    margin-left: 0 !important;\r\n                    margin-right: auto !important;\r\n                    float: none !important;\r\n                }\r\n                table.o_xs-right {\r\n                    margin-left: auto !important;\r\n                    margin-right: 0 !important;\r\n                    float: none !important;\r\n                }\r\n                table.o_xs-center {\r\n                    margin-left: auto !important;\r\n                    margin-right: auto !important;\r\n                    float: none !important;\r\n                }\r\n                h1.o_heading {\r\n                    font-size: 32px !important;\r\n                    line-height: 41px !important;\r\n                }\r\n                h2.o_heading {\r\n                    font-size: 26px !important;\r\n                    line-height: 37px !important;\r\n                }\r\n                h3.o_heading {\r\n                    font-size: 20px !important;\r\n                    line-height: 30px !important;\r\n                }\r\n                .o_xs-py-md {\r\n                    padding-top: 24px !important;\r\n                    padding-bottom: 24px !important;\r\n                }\r\n                .o_xs-pt-xs {\r\n                    padding-top: 8px !important;\r\n                }\r\n                .o_xs-pb-xs {\r\n                    padding-bottom: 8px !important;\r\n                }\r\n            }\r\n            @media screen {\r\n                @font-face {\r\n                    font-family: &quot;Roboto&quot;;\r\n                    font-style: normal;\r\n                    font-weight: 400;\r\n                    src: local(&quot;Roboto&quot;), local(&quot;Roboto-Regular&quot;), url(https://fonts.gstatic.com/s/roboto/v18/KFOmCnqEu92Fr1Mu7GxKOzY.woff2) format(&quot;woff2&quot;);\r\n                    unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;\r\n                }\r\n                @font-face {\r\n                    font-family: &quot;Roboto&quot;;\r\n                    font-style: normal;\r\n                    font-weight: 400;\r\n                    src: local(&quot;Roboto&quot;), local(&quot;Roboto-Regular&quot;), url(https://fonts.gstatic.com/s/roboto/v18/KFOmCnqEu92Fr1Mu4mxK.woff2) format(&quot;woff2&quot;);\r\n                    unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;\r\n                }\r\n                @font-face {\r\n                    font-family: &quot;Roboto&quot;;\r\n                    font-style: normal;\r\n                    font-weight: 700;\r\n                    src: local(&quot;Roboto Bold&quot;), local(&quot;Roboto-Bold&quot;), url(https://fonts.gstatic.com/s/roboto/v18/KFOlCnqEu92Fr1MmWUlfChc4EsA.woff2) format(&quot;woff2&quot;);\r\n                    unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;\r\n                }\r\n                @font-face {\r\n                    font-family: &quot;Roboto&quot;;\r\n                    font-style: normal;\r\n                    font-weight: 700;\r\n                    src: local(&quot;Roboto Bold&quot;), local(&quot;Roboto-Bold&quot;), url(https://fonts.gstatic.com/s/roboto/v18/KFOlCnqEu92Fr1MmWUlfBBc4.woff2) format(&quot;woff2&quot;);\r\n                    unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;\r\n                }\r\n                .o_sans,\r\n                .o_heading {\r\n                    font-family: &quot;Roboto&quot;, sans-serif !important;\r\n                }\r\n                .o_heading,\r\n                strong,\r\n                b {\r\n                    font-weight: 700 !important;\r\n                }\r\n                a[x-apple-data-detectors] {\r\n                    color: inherit !important;\r\n                    text-decoration: none !important;\r\n                }\r\n            }\r\n        &lt;/style&gt;\r\n        &lt;!--[if mso]&gt;\r\n            &lt;style&gt;\r\n                table {\r\n                    border-collapse: collapse;\r\n                }\r\n                .o_col {\r\n                    float: left;\r\n                }\r\n            &lt;/style&gt;\r\n            &lt;xml&gt;\r\n                &lt;o:OfficeDocumentSettings&gt;\r\n                    &lt;o:PixelsPerInch&gt;96&lt;/o:PixelsPerInch&gt;\r\n                &lt;/o:OfficeDocumentSettings&gt;\r\n            &lt;/xml&gt;\r\n        &lt;![endif]--&gt;\r\n    \r\n    \r\n        &lt;!-- preview-text --&gt;\r\n        &lt;table width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; role=&quot;presentation&quot;&gt;\r\n            &lt;tbody&gt;\r\n                &lt;tr&gt;\r\n                    &lt;td class=&quot;o_hide&quot; align=&quot;center&quot; style=&quot;display: none; font-size: 0; max-height: 0; width: 0; line-height: 0; overflow: hidden; mso-hide: all; visibility: hidden;&quot;&gt;Email Summary (Hidden)&lt;/td&gt;\r\n                &lt;/tr&gt;\r\n            &lt;/tbody&gt;\r\n        &lt;/table&gt;\r\n        &lt;!-- header --&gt;\r\n        &lt;table width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; role=&quot;presentation&quot;&gt;\r\n          &lt;tbody&gt;\r\n            &lt;tr&gt;\r\n              &lt;td class=&quot;o_bg-light o_px-xs o_pt-lg o_xs-pt-xs&quot; align=&quot;center&quot; style=&quot;background-color: #dbe5ea;padding-left: 8px;padding-right: 8px;padding-top: 32px;&quot;&gt;\r\n                &lt;!--[if mso]&gt;&lt;table width=&quot;432&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; role=&quot;presentation&quot;&gt;&lt;tbody&gt;&lt;tr&gt;&lt;td&gt;&lt;![endif]--&gt;\r\n                &lt;table class=&quot;o_block-xs&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; role=&quot;presentation&quot; style=&quot;max-width: 432px;margin: 0 auto;&quot;&gt;\r\n                  &lt;tbody&gt;\r\n                    &lt;tr&gt;\r\n                      &lt;td class=&quot;o_bg-dark o_px o_py-md o_br-t o_sans o_text&quot; align=&quot;center&quot; style=&quot;font-family: Helvetica, Arial, sans-serif;margin-top: 0px;margin-bottom: 0px;font-size: 16px;line-height: 24px;background-color: #242b3d;border-radius: 4px 4px 0px 0px;padding-left: 16px;padding-right: 16px;padding-top: 24px;padding-bottom: 24px;&quot;&gt;\r\n                        &lt;p style=&quot;margin-top: 0px;margin-bottom: 0px;&quot;&gt;&lt;a class=&quot;o_text-white&quot; href=&quot;{{siteurl}}&quot; style=&quot;text-decoration: none;outline: none;color: #ffffff;&quot;&gt;&lt;img src=&quot;{{sitelogo}}&quot; width=&quot;150&quot; height=&quot;40&quot; alt=&quot;{{sitename}}&quot; style=&quot;max-width: 150px;-ms-interpolation-mode: bicubic;vertical-align: middle;border: 0;line-height: 100%;height: auto;outline: none;text-decoration: none;&quot;&gt;&lt;/a&gt;&lt;/p&gt;\r\n                      &lt;/td&gt;\r\n                    &lt;/tr&gt;\r\n                  &lt;/tbody&gt;\r\n                &lt;/table&gt;\r\n                &lt;!--[if mso]&gt;&lt;/td&gt;&lt;/tr&gt;&lt;/table&gt;&lt;![endif]--&gt;\r\n              &lt;/td&gt;\r\n            &lt;/tr&gt;\r\n          &lt;/tbody&gt;\r\n        &lt;/table&gt;', '&lt;!-- hero-dark-button --&gt;\n&lt;table width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; role=&quot;presentation&quot;&gt;\n  &lt;tbody&gt;\n    &lt;tr&gt;\n      &lt;td class=&quot;o_bg-light o_px-xs&quot; align=&quot;center&quot; style=&quot;background-color: #dbe5ea;padding-left: 8px;padding-right: 8px;&quot;&gt;\n        &lt;!--[if mso]&gt;&lt;table width=&quot;432&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; role=&quot;presentation&quot;&gt;&lt;tbody&gt;&lt;tr&gt;&lt;td&gt;&lt;![endif]--&gt;\n        &lt;table class=&quot;o_block-xs&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; role=&quot;presentation&quot; style=&quot;max-width: 432px;margin: 0 auto;&quot;&gt;\n          &lt;tbody&gt;\n            &lt;tr&gt;\n              &lt;td class=&quot;o_bg-dark o_px-md o_py-xl o_xs-py-md o_sans o_text-md o_text-white&quot; align=&quot;center&quot; style=&quot;font-family: Helvetica, Arial, sans-serif;margin-top: 0px;margin-bottom: 0px;font-size: 19px;line-height: 28px;background-color: #343d54;color: #ffffff;padding-left: 24px;padding-right: 24px;padding-top: 64px;padding-bottom: 64px;&quot;&gt;\n                &lt;h2 class=&quot;o_heading o_mb-xxs&quot; style=&quot;font-family: Helvetica, Arial, sans-serif;font-weight: bold;margin-top: 0px;margin-bottom: 4px;font-size: 30px;line-height: 39px;&quot;&gt;{{email_header}}&lt;/h2&gt;\n                &lt;p class=&quot;o_mb-md&quot; style=&quot;margin-top: 0px;margin-bottom: 24px;&quot;&gt;{{email_summary}}&lt;/p&gt;\n                &lt;!-- &lt;table align=&quot;center&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; role=&quot;presentation&quot;&gt;\n                  &lt;tbody&gt;\n                    &lt;tr&gt;\n                      &lt;td width=&quot;300&quot; class=&quot;o_btn o_bg-primary o_br o_heading o_text&quot; align=&quot;center&quot; style=&quot;font-family: Helvetica, Arial, sans-serif;font-weight: bold;margin-top: 0px;margin-bottom: 0px;font-size: 16px;line-height: 24px;mso-padding-alt: 12px 24px;background-color: #126de5;border-radius: 4px;&quot;&gt;\n                        &lt;a class=&quot;o_text-white&quot; href=&quot;https://example.com/&quot; style=&quot;text-decoration: none;outline: none;color: #ffffff;display: block;padding: 12px 24px;mso-text-raise: 3px;&quot;&gt;Go to My Account&lt;/a&gt;\n                      &lt;/td&gt;\n                    &lt;/tr&gt;\n                  &lt;/tbody&gt;\n                &lt;/table&gt; --&gt;\n              &lt;/td&gt;\n            &lt;/tr&gt;\n          &lt;/tbody&gt;\n        &lt;/table&gt;\n        &lt;!--[if mso]&gt;&lt;/td&gt;&lt;/tr&gt;&lt;/table&gt;&lt;![endif]--&gt;\n      &lt;/td&gt;\n    &lt;/tr&gt;\n  &lt;/tbody&gt;\n&lt;/table&gt;\n&lt;!-- spacer --&gt;\n&lt;table width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; role=&quot;presentation&quot;&gt;\n  &lt;tbody&gt;\n    &lt;tr&gt;\n      &lt;td class=&quot;o_bg-light o_px-xs&quot; align=&quot;center&quot; style=&quot;background-color: #dbe5ea;padding-left: 8px;padding-right: 8px;&quot;&gt;\n        &lt;!--[if mso]&gt;&lt;table width=&quot;432&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; role=&quot;presentation&quot;&gt;&lt;tbody&gt;&lt;tr&gt;&lt;td&gt;&lt;![endif]--&gt;\n        &lt;table class=&quot;o_block-xs&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; role=&quot;presentation&quot; style=&quot;max-width: 432px;margin: 0 auto;&quot;&gt;\n          &lt;tbody&gt;\n            &lt;tr&gt;\n              &lt;td class=&quot;o_bg-white&quot; style=&quot;font-size: 24px;line-height: 24px;height: 24px;background-color: #ffffff;&quot;&gt;&amp;nbsp; &lt;/td&gt;\n            &lt;/tr&gt;\n          &lt;/tbody&gt;\n        &lt;/table&gt;\n        &lt;!--[if mso]&gt;&lt;/td&gt;&lt;/tr&gt;&lt;/table&gt;&lt;![endif]--&gt;\n      &lt;/td&gt;\n    &lt;/tr&gt;\n  &lt;/tbody&gt;\n&lt;/table&gt;\n&lt;!-- content-lg-left --&gt;\n&lt;table width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; role=&quot;presentation&quot;&gt;\n  &lt;tbody&gt;\n    &lt;tr&gt;\n      &lt;td class=&quot;o_bg-light o_px-xs&quot; align=&quot;center&quot; style=&quot;background-color: #dbe5ea;padding-left: 8px;padding-right: 8px;&quot;&gt;\n        &lt;!--[if mso]&gt;&lt;table width=&quot;432&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; role=&quot;presentation&quot;&gt;&lt;tbody&gt;&lt;tr&gt;&lt;td&gt;&lt;![endif]--&gt;\n        &lt;table class=&quot;o_block-xs&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; role=&quot;presentation&quot; style=&quot;max-width: 432px;margin: 0 auto;&quot;&gt;\n          &lt;tbody&gt;\n            &lt;tr&gt;\n              &lt;td class=&quot;o_bg-white o_px-md o_py o_sans o_text o_text-secondary&quot; align=&quot;left&quot; style=&quot;font-family: Helvetica, Arial, sans-serif;margin-top: 0px;margin-bottom: 0px;font-size: 16px;line-height: 24px;background-color: #ffffff;color: #424651;padding-left: 24px;padding-right: 24px;padding-top: 16px;padding-bottom: 16px;&quot;&gt;\n                &lt;h4 class=&quot;o_heading o_text-dark o_mb-xs&quot; style=&quot;font-family: Helvetica, Arial, sans-serif;font-weight: bold;margin-top: 0px;margin-bottom: 8px;color: #242b3d;font-size: 18px;line-height: 23px;&quot;&gt;&lt;/h4&gt;\n                &lt;p style=&quot;margin-top: 0px;margin-bottom: 0px;&quot;&gt;{{email_body}}&lt;/p&gt;\n              &lt;/td&gt;\n            &lt;/tr&gt;\n          &lt;/tbody&gt;\n        &lt;/table&gt;\n        &lt;!--[if mso]&gt;&lt;/td&gt;&lt;/tr&gt;&lt;/table&gt;&lt;![endif]--&gt;\n      &lt;/td&gt;\n    &lt;/tr&gt;\n  &lt;/tbody&gt;\n&lt;/table&gt;\n&lt;!-- spacer-lg --&gt;\n&lt;table width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; role=&quot;presentation&quot;&gt;\n  &lt;tbody&gt;\n    &lt;tr&gt;\n      &lt;td class=&quot;o_bg-light o_px-xs&quot; align=&quot;center&quot; style=&quot;background-color: #dbe5ea;padding-left: 8px;padding-right: 8px;&quot;&gt;\n        &lt;!--[if mso]&gt;&lt;table width=&quot;432&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; role=&quot;presentation&quot;&gt;&lt;tbody&gt;&lt;tr&gt;&lt;td&gt;&lt;![endif]--&gt;\n        &lt;table class=&quot;o_block-xs&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; role=&quot;presentation&quot; style=&quot;max-width: 432px;margin: 0 auto;&quot;&gt;\n          &lt;tbody&gt;\n            &lt;tr&gt;\n              &lt;td class=&quot;o_bg-white&quot; style=&quot;font-size: 48px;line-height: 48px;height: 48px;background-color: #ffffff;&quot;&gt;&amp;nbsp; &lt;/td&gt;\n            &lt;/tr&gt;\n          &lt;/tbody&gt;\n        &lt;/table&gt;\n        &lt;!--[if mso]&gt;&lt;/td&gt;&lt;/tr&gt;&lt;/table&gt;&lt;![endif]--&gt;\n      &lt;/td&gt;\n    &lt;/tr&gt;\n  &lt;/tbody&gt;\n&lt;/table&gt;\n', '&lt;!-- footer-white --&gt;\n&lt;table width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; role=&quot;presentation&quot;&gt;\n    &lt;tbody&gt;\n        &lt;tr&gt;\n            &lt;td class=&quot;o_bg-light o_px-xs o_pb-lg o_xs-pb-xs&quot; align=&quot;center&quot; style=&quot;background-color: #dbe5ea; padding-left: 8px; padding-right: 8px; padding-bottom: 32px;&quot;&gt;\n                &lt;!--[if mso]&gt;&lt;table width=&quot;432&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; role=&quot;presentation&quot;&gt;&lt;tbody&gt;&lt;tr&gt;&lt;td&gt;&lt;![endif]--&gt;\n                &lt;table class=&quot;o_block-xs&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; role=&quot;presentation&quot; style=&quot;max-width: 432px; margin: 0 auto;&quot;&gt;\n                    &lt;tbody&gt;\n                        &lt;tr&gt;\n                            &lt;td class=&quot;o_bg-white o_px-md o_py-lg o_bt-light o_br-b o_sans o_text-xs o_text-light&quot; align=&quot;center&quot; style=&quot;\n                                    font-family: Helvetica, Arial, sans-serif;\n                                    margin-top: 0px;\n                                    margin-bottom: 0px;\n                                    font-size: 14px;\n                                    line-height: 21px;\n                                    /*background-color: #ffffff;*/\n                                    background-color: #242b3d;\n                                    /*color: #82899a;*/\n                                    color: #fff;\n                                    border-top: 1px solid #d3dce0;\n                                    border-radius: 0px 0px 4px 4px;\n                                    padding-left: 24px;\n                                    padding-right: 24px;\n                                    padding-top: 32px;\n                                    padding-bottom: 32px;\n                                &quot;&gt;\n                                &lt;p class=&quot;o_mb&quot; style=&quot;margin-top: 0px; margin-bottom: 16px;&quot;&gt;\n                                    &lt;a class=&quot;o_text-primary&quot; href=&quot;{{sitename}}&quot; style=&quot;text-decoration: none; outline: none; color: #126de5;&quot;&gt;\n                                        &lt;img src=&quot;{{siteicon}}&quot; width=&quot;50px&quot; height=&quot;50&quot; alt=&quot;{{sitename}}&quot; style=&quot;max-width: 50px; -ms-interpolation-mode: bicubic; vertical-align: middle; border: 0; line-height: 100%; height: auto; outline: none; text-decoration: none;&quot;&gt;\n                                    &lt;/a&gt;\n                                &lt;/p&gt;\n                                &lt;p class=&quot;o_mb&quot; style=&quot;margin-top: 0px; margin-bottom: 8px;&quot;&gt;&copy; {{date}} {{sitename}}&lt;/p&gt;\n                                &lt;p class=&quot;o_mb&quot; style=&quot;margin-top: 0px; margin-bottom: 16px;&quot;&gt;\n                                    {{siteaddress}}\n                                &lt;/p&gt;\n                                &lt;p style=&quot;margin-top: 0px; margin-bottom: 10px;&quot;&gt;\n                                    &lt;a class=&quot;o_text-dark_light&quot; href=&quot;{{facebook_link}}&quot; style=&quot;text-decoration: none; outline: none; color: #a0a3ab;&quot;&gt;\n                                        &lt;img src=&quot;{{siteurl}}/uploads/facebook-light.png&quot; width=&quot;36&quot; height=&quot;36&quot; alt=&quot;fb&quot; style=&quot;max-width: 36px; -ms-interpolation-mode: bicubic; vertical-align: middle; border: 0; line-height: 100%; height: auto; outline: none; text-decoration: none;&quot;&gt;\n                                    &lt;/a&gt;\n                                    &lt;span&gt; &amp;nbsp;&lt;/span&gt;\n                                    &lt;a class=&quot;o_text-dark_light&quot; href=&quot;{{twitter_link}}&quot; style=&quot;text-decoration: none; outline: none; color: #a0a3ab;&quot;&gt;\n                                        &lt;img src=&quot;{{siteurl}}/uploads/twitter-light.png&quot; width=&quot;36&quot; height=&quot;36&quot; alt=&quot;tw&quot; style=&quot;max-width: 36px; -ms-interpolation-mode: bicubic; vertical-align: middle; border: 0; line-height: 100%; height: auto; outline: none; text-decoration: none;&quot;&gt;\n                                    &lt;/a&gt;\n                                    &lt;span&gt; &amp;nbsp;&lt;/span&gt;\n                                    &lt;a class=&quot;o_text-dark_light&quot; href=&quot;{{instagram_link}}&quot; style=&quot;text-decoration: none; outline: none; color: #a0a3ab;&quot;&gt;\n                                        &lt;img src=&quot;{{siteurl}}/uploads/instagram-light.png&quot; width=&quot;36&quot; height=&quot;36&quot; alt=&quot;ig&quot; style=&quot;max-width: 36px; -ms-interpolation-mode: bicubic; vertical-align: middle; border: 0; line-height: 100%; height: auto; outline: none; text-decoration: none;&quot;&gt;\n                                    &lt;/a&gt;\n                                    &lt;span&gt; &amp;nbsp;&lt;/span&gt;\n                                    &lt;a class=&quot;o_text-dark_light&quot; href=&quot;{{linkedin_link}}&quot; style=&quot;text-decoration: none; outline: none; color: #a0a3ab;&quot;&gt;\n                                        &lt;img src=&quot;{{siteurl}}/uploads/linkedin-light.png&quot; width=&quot;36&quot; height=&quot;36&quot; alt=&quot;ig&quot; style=&quot;max-width: 30px; -ms-interpolation-mode: bicubic; vertical-align: middle; border: 0; line-height: 100%; height: auto; outline: none; text-decoration: none;&quot;&gt;\n                                    &lt;/a&gt;\n                                &lt;/p&gt;\n\n                                &lt;p style=&quot;margin-top: 0px; margin-bottom: 0px;&quot;&gt;\n                                    &lt;a class=&quot;o_text-light o_underline&quot; href=&quot;{{siteurl}}/contact&quot; style=&quot;text-decoration: underline; outline: none; color: #fff;&quot;&gt;Support&lt;/a&gt; &lt;span class=&quot;o_hide-xs&quot;&gt;&amp;nbsp; &bull; &amp;nbsp;&lt;/span&gt;\n                                    &lt;!-- &lt;br class=&quot;o_hide-lg&quot; style=&quot;display: none; font-size: 0; max-height: 0; width: 0; line-height: 0; overflow: hidden; mso-hide: all; visibility: hidden;&quot; /&gt; --&gt;\n                                    &lt;!-- &lt;a class=&quot;o_text-light o_underline&quot; href=&quot;https://example.com/&quot; style=&quot;text-decoration: underline; outline: none; color: #82899a;&quot;&gt;Preferences&lt;/a&gt; &lt;span class=&quot;o_hide-xs&quot;&gt;&amp;nbsp; &bull; &amp;nbsp;&lt;/span&gt; --&gt;\n                                    &lt;br class=&quot;o_hide-lg&quot; style=&quot;display: none; font-size: 0; max-height: 0; width: 0; line-height: 0; overflow: hidden; mso-hide: all; visibility: hidden;&quot;&gt;\n                                    &lt;a class=&quot;o_text-light o_underline&quot; href=&quot;{{unsubscribe_link}}&quot; style=&quot;text-decoration: underline; outline: none; color: #fff;&quot;&gt;Unsubscribe&lt;/a&gt;\n                                &lt;/p&gt;\n                            &lt;/td&gt;\n                        &lt;/tr&gt;\n                    &lt;/tbody&gt;\n                &lt;/table&gt;\n                &lt;!--[if mso]&gt;&lt;/td&gt;&lt;/tr&gt;&lt;/table&gt;&lt;![endif]--&gt;\n                &lt;div class=&quot;o_hide-xs&quot; style=&quot;font-size: 64px; line-height: 64px; height: 64px;&quot;&gt;&amp;nbsp;&lt;/div&gt;\n            &lt;/td&gt;\n        &lt;/tr&gt;\n    &lt;/tbody&gt;\n&lt;/table&gt;\n\n\n', '1621858969', '1622063423');

-- --------------------------------------------------------

--
-- Table structure for table `email_variables`
--

CREATE TABLE `email_variables` (
  `id` int(11) NOT NULL,
  `vkey` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mailings`
--

CREATE TABLE `mailings` (
  `id` int(11) NOT NULL,
  `send_to` varchar(100) DEFAULT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `name`, `value`) VALUES
(1, 'site_name', 'PHPEGen'),
(2, 'site_logo', NULL),
(3, 'site_icon', NULL),
(4, 'facebook_link', NULL),
(5, 'instagram_link', NULL),
(6, 'twitter_link', NULL),
(7, 'site_email', 'info@site.com'),
(8, 'site_phone', ''),
(9, 'site_address', ''),
(10, 'mail_method', 'mail'),
(11, 'linkedin_link', NULL),
(12, 'email_theme', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_themes`
--
ALTER TABLE `email_themes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_variables`
--
ALTER TABLE `email_variables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mailings`
--
ALTER TABLE `mailings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `email_themes`
--
ALTER TABLE `email_themes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `email_variables`
--
ALTER TABLE `email_variables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mailings`
--
ALTER TABLE `mailings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
