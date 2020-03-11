# Groups Extended for LearnDash

Git repository: https://bitbucket.org/tangibleinc/learndash-groups

## Overview

Groups Extended for LearnDash is a free plugin developed by TangiblePlugins that allows you to display a group page only to users in the group, providing a space to display group-related content.

## Dependencies

- LearnDash
- BeaverThemer (optional)

## Shortcodes

- [ldg_user_groups] - Display users's group
- [ldg_group_picture id=''] - Display the group's picture (If no ID is set, will default to the current group)
- [ldg_group_cover_picture id=''] - Display the group's cover picture (If no ID is set, will default to the current group)

## Install

Install dependencies :

```
composer install
npm install
```

Compile and minify JS and SASS :


For compile one time :
```
npm run build
```

For watching changes :
```
npm run dev
```
