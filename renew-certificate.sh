#!/bin/bash
sudo /usr/bin/certbot renew
sudo systemctl restart apache2
