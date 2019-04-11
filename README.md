Install dependencies :

```
composer install
```
```
npm install
```

Compile and minify the js sources :


For compile one time :
```
npx babel sources/js --out-dir assets/js --minified --source-maps
```

For watching changes :
```
npx babel sources/js --watch --out-dir assets/js --minified --source-maps
```


Watch and minify the scss sources :
```
sass --watch sources/scss:assets/css --style compressed
```
