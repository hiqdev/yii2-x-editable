hiqdev/yii2-x-editable commits history
--------------------------------------

## [0.2.0] - 2017-04-13

- Prevent remote formatting when value is not a sting
    - [eee8984] 2017-04-13 csfixed [@SilverFire]
    - [1aa6e95] 2017-04-12 Prevent remote formatting when value is not a sting [@SilverFire]
    - [4233389] 2017-02-20 csfixed [@hiqsol]
- Removed use of `hipanel\grid\DataColumn` in favour of `hiqdev\higrid\DataColumn`
    - [b0709e3] 2017-02-20 removed use of `hipanel\grid\DataColumn` in favour of `hiqdev\higrid\DataColumn` [@hiqsol]
- Updated `ComboXEditable.js` to follow Combo API changes
    - [d464f79] 2017-02-13 Updated ComboXEditable.js to follow Combo API changes [@SilverFire]
    - [0b070b4] 2016-07-18 fixing dependencies [@hiqsol]
    - [2647e45] 2016-07-18 fixing dependencies [@hiqsol]
    - [cc6cb3e] 2016-07-16 csfixed [@hiqsol]
- Enhanced XEditableTrait in order to support custom selector and per-id initialisation
    - [d0fb2f3] 2016-07-15 Enhanced XEditableTrait in order to support custom selector [@SilverFire]
    - [92f50e6] 2016-07-01 Updated config [@SilverFire]
    - [2b9abc8] 2016-07-01 Added hisite config [@SilverFire]
    - [92ade41] 2016-05-13 Updated XEditableTrait to initialise Xeditable per-id instad of per-attribute [@SilverFire]

## [0.1.2] - 2016-04-27

- Fixed version constraints in `composer.json`
    - [c5e1d0b] 2016-04-27 fixed version constraints in `composer.json` [@hiqsol]

## [0.1.1] - 2016-04-27

- Added tests and fixed build
    - [198caa1] 2016-04-27 phpcsfixed [@hiqsol]
    - [5898986] 2016-04-27 added tests [@hiqsol]
    - [1b6700a] 2016-04-27 rehideved [@hiqsol]
- Fixed errors
    - [c4eb91d] 2016-04-22 Fixed ComboXEditable.js::value2submit invalid conversion when this.isMultiple is set to false [@SilverFire]
    - [b7cbc38] 2016-02-11 XeditableColumn added word-break [@SilverFire]
    - [9a968cd] 2015-10-09 Fixed default displayValue generation. Not sure, whether it works good :) [@SilverFire]
    - [974e1c8] 2015-09-28 Default value of data-disaplay-value forced to be a string [@SilverFire]
    - [0d2c03e] 2015-09-25 Added RemoteFormat Xeditable (undocumented) [@SilverFire]
    - [f6cf4d5] 2015-09-25 XEditable widget - removed $format [@SilverFire]
    - [8d11baa] 2015-09-25 Trait: added data-display-value, data-value, linkOptions. Minor improvements [@SilverFire]
    - [f9f049b] 2015-09-25 Column uses widget instead of trait [@SilverFire]
    - [1075118] 2015-09-18 fixed hidev config [@hiqsol]
    - [fd374a0] 2015-09-18 fixed mistake [@hiqsol]
    - [6e089a4] 2015-09-03 Fixes [@SilverFire]
- Added formatting with format option
    - [6ffa011] 2015-09-24 + formatting with format option [@hiqsol]
- Added ComboXEditable
    - [3991509] 2015-09-02 ComboXEditable implemented [@SilverFire]
    - [8389750] 2015-08-31 Some changes [@tafid]
    - [046fd1f] 2015-08-28 Add auto detedt url from model scenario [@tafid]
    - [33bace8] 2015-08-26 XEditableColumn - removed manual value set [@SilverFire]
- Refactored
    - [0a691c3] 2015-07-29 refactored [@hiqsol]
    - [603f881] 2015-07-22 simplified rendering: used parent::renderDataCellContent [@hiqsol]
- Fixed code styling: hideved and php-cs-fixed
    - [3921ed1] 2015-07-22 php-cs-fixed [@hiqsol]
    - [f1806fe] 2015-07-22 moved to src, rehideved [@hiqsol]
    - [c806435] 2015-07-22 * using raw format for data cell content [@hiqsol]
- Fixed minor issues
    - [a8fc857] 2015-07-17 Add compatibility work XEditableColumn with Collection [@tafid]
    - [57793e9] 2015-07-09 Change submited params [@tafid]
    - [a29aef8] 2015-06-03 Mode fix [@tafid]
    - [5bdefb4] 2015-05-27 Some fixes [@tafid]
    - [39beb32] 2015-05-27 Test version [@tafid]

## [0.1.0] - 2015-05-22

- Inited
    - [fc9cbd8] 2015-05-22 Folder rename [@tafid]
    - [dffd122] 2015-05-22 Inital commint [@tafid]
    - [fd6c34d] 2015-05-22 inited [@hiqsol]
## Development started 2015-05-22

## [Development started] - 2015-05-22

[@hiqsol]: https://github.com/hiqsol
[sol@hiqdev.com]: https://github.com/hiqsol
[@SilverFire]: https://github.com/SilverFire
[d.naumenko.a@gmail.com]: https://github.com/SilverFire
[@tafid]: https://github.com/tafid
[andreyklochok@gmail.com]: https://github.com/tafid
[@BladeRoot]: https://github.com/BladeRoot
[bladeroot@gmail.com]: https://github.com/BladeRoot
[c5e1d0b]: https://github.com/hiqdev/yii2-x-editable/commit/c5e1d0b
[198caa1]: https://github.com/hiqdev/yii2-x-editable/commit/198caa1
[5898986]: https://github.com/hiqdev/yii2-x-editable/commit/5898986
[1b6700a]: https://github.com/hiqdev/yii2-x-editable/commit/1b6700a
[c4eb91d]: https://github.com/hiqdev/yii2-x-editable/commit/c4eb91d
[b7cbc38]: https://github.com/hiqdev/yii2-x-editable/commit/b7cbc38
[9a968cd]: https://github.com/hiqdev/yii2-x-editable/commit/9a968cd
[974e1c8]: https://github.com/hiqdev/yii2-x-editable/commit/974e1c8
[0d2c03e]: https://github.com/hiqdev/yii2-x-editable/commit/0d2c03e
[f6cf4d5]: https://github.com/hiqdev/yii2-x-editable/commit/f6cf4d5
[8d11baa]: https://github.com/hiqdev/yii2-x-editable/commit/8d11baa
[f9f049b]: https://github.com/hiqdev/yii2-x-editable/commit/f9f049b
[1075118]: https://github.com/hiqdev/yii2-x-editable/commit/1075118
[fd374a0]: https://github.com/hiqdev/yii2-x-editable/commit/fd374a0
[6e089a4]: https://github.com/hiqdev/yii2-x-editable/commit/6e089a4
[6ffa011]: https://github.com/hiqdev/yii2-x-editable/commit/6ffa011
[3991509]: https://github.com/hiqdev/yii2-x-editable/commit/3991509
[8389750]: https://github.com/hiqdev/yii2-x-editable/commit/8389750
[046fd1f]: https://github.com/hiqdev/yii2-x-editable/commit/046fd1f
[33bace8]: https://github.com/hiqdev/yii2-x-editable/commit/33bace8
[0a691c3]: https://github.com/hiqdev/yii2-x-editable/commit/0a691c3
[603f881]: https://github.com/hiqdev/yii2-x-editable/commit/603f881
[3921ed1]: https://github.com/hiqdev/yii2-x-editable/commit/3921ed1
[f1806fe]: https://github.com/hiqdev/yii2-x-editable/commit/f1806fe
[c806435]: https://github.com/hiqdev/yii2-x-editable/commit/c806435
[a8fc857]: https://github.com/hiqdev/yii2-x-editable/commit/a8fc857
[57793e9]: https://github.com/hiqdev/yii2-x-editable/commit/57793e9
[a29aef8]: https://github.com/hiqdev/yii2-x-editable/commit/a29aef8
[5bdefb4]: https://github.com/hiqdev/yii2-x-editable/commit/5bdefb4
[39beb32]: https://github.com/hiqdev/yii2-x-editable/commit/39beb32
[fc9cbd8]: https://github.com/hiqdev/yii2-x-editable/commit/fc9cbd8
[dffd122]: https://github.com/hiqdev/yii2-x-editable/commit/dffd122
[fd6c34d]: https://github.com/hiqdev/yii2-x-editable/commit/fd6c34d
[1aa6e95]: https://github.com/hiqdev/yii2-x-editable/commit/1aa6e95
[4233389]: https://github.com/hiqdev/yii2-x-editable/commit/4233389
[b0709e3]: https://github.com/hiqdev/yii2-x-editable/commit/b0709e3
[d464f79]: https://github.com/hiqdev/yii2-x-editable/commit/d464f79
[0b070b4]: https://github.com/hiqdev/yii2-x-editable/commit/0b070b4
[2647e45]: https://github.com/hiqdev/yii2-x-editable/commit/2647e45
[cc6cb3e]: https://github.com/hiqdev/yii2-x-editable/commit/cc6cb3e
[d0fb2f3]: https://github.com/hiqdev/yii2-x-editable/commit/d0fb2f3
[92f50e6]: https://github.com/hiqdev/yii2-x-editable/commit/92f50e6
[2b9abc8]: https://github.com/hiqdev/yii2-x-editable/commit/2b9abc8
[92ade41]: https://github.com/hiqdev/yii2-x-editable/commit/92ade41
[Under development]: https://github.com/hiqdev/yii2-x-editable/compare/0.2.0...HEAD
[0.1.2]: https://github.com/hiqdev/yii2-x-editable/compare/0.1.1...0.1.2
[0.1.1]: https://github.com/hiqdev/yii2-x-editable/compare/0.1.0...0.1.1
[0.1.0]: https://github.com/hiqdev/yii2-x-editable/releases/tag/0.1.0
[0.2.0]: https://github.com/hiqdev/yii2-x-editable/compare/0.1.2...0.2.0
[eee8984]: https://github.com/hiqdev/yii2-x-editable/commit/eee8984
