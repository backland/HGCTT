#!/bin/bash
sudo /usr/local/bin/certbot renew
sudo /opt/bitnami/ctlscript.sh restart apache
