import $ from 'jquery';

class Search {
    // 1. describe and initiate object
    constructor() {
        this.openButton = $('.js-search-trigger');
        this.closeButton = $('.search-overlay__close');
        this.searchOverlay = $('.search-overlay');
        this.searchField = $('#search-term');
        this.resultsDiv = $('#search-overlay__results');
        this.events();
        this.isOverlayOpen = false;
        this.isSpinnerVisible = false;
        this.previousValue;
        this.typingTimer;
    }

    // 2. events
    events() {
        // bind(this) is neccessary here because 'this' will be referenced 
        // as clicked/interacted with html-element in the browser, not this object (Search)
        this.openButton.on('click', this.openOverlay.bind(this));
        this.closeButton.on('click', this.closeOverlay.bind(this));
        $(document).on('keydown', this.keyPressDispatcher.bind(this));
        this.searchField.on('keyup', this.typingLogic.bind(this));
    }

    // 3. methods
    typingLogic() {
        // search field value has changed?
        if (this.searchField.val() != this.previousValue) {
            // reset timer
            clearTimeout(this.typingTimer);

            // search field value NOT empty?
            if (this.searchField.val()) {

                // Spinner NOT visible?
                if (!this.isSpinnerVisible) {
                    // show spinner animation
                    this.resultsDiv.html('<div class="spinner-loader"></div>');
                    this.isSpinnerVisible = true;
                }
                // fire getResults on timeout
                this.typingTimer = setTimeout(this.getResults.bind(this), 2000);

                // search field IS empty?
            } else {
                // clear resultsDiv and make sure spinner is not showing
                this.resultsDiv.html('');
                this.isSpinnerVisible = false;
            }
        }

        // store previously typed value
        this.previousValue = this.searchField.val();
    }

    getResults() {
        this.resultsDiv.html('Imagine real search results here...');
        this.isSpinnerVisible = false;
    }

    keyPressDispatcher(e) {
        // "s" pressed AND overlay not already open AND no other textfield focussed -> open Overlay
        if (e.keyCode === 83 && !this.isOverlayOpen && !$('input, textarea').is(':focus')) {
            this.openOverlay();
        }
        // "esc" pressed -> close Overlay
        if (e.keyCode === 27 && this.isOverlayOpen) {
            this.closeOverlay();
        }
    }
    
    openOverlay() {
        this.searchOverlay.addClass('search-overlay--active');
        $('body').addClass('body-no-scroll');
        console.log('open method');
        this.isOverlayOpen = true;
    }

    closeOverlay() {
        this.searchOverlay.removeClass('search-overlay--active');
        $('body').removeClass('body-no-scroll');
        console.log('close method');
        this.isOverlayOpen = false;
    }
}

export default Search;