# Cross Site Script (XSS)

Cross Site Scripting (XSS) attacks are attacks in which malicious scrripts are injected
into a website. XSS injections consist of scripts that run on the client side, typically
written in Javascript.

There are three forms of XSS attacks.

- Stored XSS
- Reflected XSS
- DOM Based XSS

## Stored XSS

Stored XSS occurs when user input is stored on the target server(i.e. Databases, comment boxes, etc)
An unsuspecting victim retreives the XSS payload and the payload is executed on the victim's
browser.

## Reflected XSS

Reflected XSS occurs when the payload is displayed on the webpage through an error, search result
or other similar responses. Unlike Stored XSS, it is not stored on the webserver.

