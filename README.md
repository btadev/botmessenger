# [![ChienIT](https://s.gravatar.com/avatar/36d29d01ee8909a7d386291516a94edb?s=32)](https://github.com/chiendevit) *ChienIt Bot Messenger*
[![Latest Stable Version](https://poser.pugx.org/chiendevit/botmessenger/v/stable)](https://packagist.org/packages/chiendevit/botmessenger)
[![Total Downloads](https://poser.pugx.org/chiendevit/botmessenger/downloads)](https://packagist.org/packages/chiendevit/botmessenger)
[![License](https://poser.pugx.org/chiendevit/botmessenger/license)](https://packagist.org/packages/chiendevit/botmessenger)

*A library to help develop the fastest and best bot message on the **PHP** platform. Current, it support the drive after:*

  - <a href="https://facebook.com"><img src="https://static.xx.fbcdn.net/rsrc.php/yo/r/iRmz9lCMBD2.ico" width="32px"/></a> **Facebook Messenger Personal**
  - <a href="https://messenger.com"><img src="https://static.xx.fbcdn.net/rsrc.php/y7/r/O6n_HQxozp9.ico" width="32px"/></a> **Facebook Messenger Fanpage**
  - <a href="https://en.wikipedia.org/wiki/Amazon_Alexa"><img src="https://upload.wikimedia.org/wikipedia/commons/c/cc/Amazon_Alexa_App_Logo.png" width="32px"/></a> **Amazon Alexa**
  - <a href="https://ciscospark.com"><img src="https://pbs.twimg.com/profile_images/988828581542309888/FILUmyzB_400x400.jpg" width="32px"/></a> **Cisco Spark**
  - <a href="https://hangouts.google.com"><img src="https://ssl.gstatic.com/chat/startpage/favicon_f1bac5c7ba3154b58080de921eb6d5ea.ico" width="32px"/></a> **Hangouts Chat**
  - <a href="https://www.hipchat.com/"><img src="https://pagerduty.digitalstacks.net/wp/wp-content/uploads/2018/01/hipchat-icon-e1517278540356.png" width="32px"/></a> **HipChat**
  - <a href="https://dev.botframework.com"><img src="https://dev.botframework.com/Client/Content/favicon.ico" width="32px"/></a> **Microsoft Bot Framework**
  - <a href="https://www.nexmo.com"><img src="https://www.nexmo.com/favicon.ico" width="32px"/></a> **Nexmo**
  - <a href="https://slack.com"><img src="https://a.slack-edge.com/436da/marketing/img/meta/favicon-32.png" width="32px"/></a> **Slack**
  - <a href="https://telegram.org/"><img src="https://telegram.org/favicon.ico" width="32px"/></a> **Telegram**
  - <a href="https://www.twilio.com"><img src="https://www.twilio.com/marketing/bundles/marketing/img/favicons/favicon.ico" width="32px"/></a> **Twilio**
  - <a href="https://en.wikipedia.org/wiki/Web"><img src="http://giantstepsmn.com/wp-content/uploads/2016/10/website-icon.png" width="32px"/></a> **Web**
  - <a href="https://www.wechat.com"><img src="https://res.wx.qq.com/a/wx_fed/wechat_portal/res/static/img/3wOU-7F.ico" width="32px"/></a> **WeChat**

### Installation & Using

*Download the **ChienIT Bot Messenger** using **Composer**:*
```sh
$ composer require chienit/botmessenger
```
*Add into composer.json*
```json
    "scripts": {
        "botmanager" : "ChienIT\\BotMessenger\\BotManager::menu"
    }
```

*Manager*
```sh
$ composer run-script botmanager
```

### Using
        $value = $this->driver->fetch($key);
