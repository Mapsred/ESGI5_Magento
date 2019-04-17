define(
    [
        'BonusFixedFees_FixedFees/js/view/checkout/summary/fixed-fees'
    ],
    function (Component) {
        'use strict';
        return Component.extend({
            /**
             * @override
             */
            isDisplayed: function () {
                return true;
            }
        });
    }
);