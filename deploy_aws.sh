#!/usr/bin/env bash

# Public URL:          http://fixgov.org
#
# Amazon S3 Bucket:    http://fixgov.org.s3-website.eu-west-2.amazonaws.com/Front.html
# - Bucket:     fixgov.org - Static website hosting - Use this bucket to host a website
# - Bucket: www.fixgov.org - Static website hosting - Redirect requests: fixgov.org
# - Bucket:     fixgov.com - Static website hosting - Redirect requests: fixgov.org
# - Bucket: www.fixgov.com - Static website hosting - Redirect requests: fixgov.org
#
# Amazon Route53 DNS:  https://console.aws.amazon.com/route53/home#hosted-zones:
# - Hosted Zones:
#     fixgov.org: NS      ns-616.awsdns-13.net | ns-1646.awsdns-13.co.uk | ns-1173.awsdns-18.org | ns-412.awsdns-51.com
#     fixgov.org: A ALIAS s3-website.eu-west-2.amazonaws.com. (z3gkzc51zf0db4)
# www.fixgov.org: A ALIAS fixgov.org.
#     fixgov.com: NS      ns-18.awsdns-02.com | ns-692.awsdns-22.net | ns-1469.awsdns-55.org | ns-1624.awsdns-11.co.uk
#     fixgov.com: A ALIAS s3-website.eu-west-2.amazonaws.com. (z3gkzc51zf0db4)
# www.fixgov.com: A ALIAS fixgov.org.


aws s3 sync ./ s3://fixgov.org --acl public-read --exclude '*.zip' --exclude '.idea/*' --exclude '.git/*'
