
./vendor/bin/jigsaw build prod
npm run production

cd ./build_production &&
rsync -zzarvh --delete . semiherdogan.net:/var/www/semiherdogan.net
