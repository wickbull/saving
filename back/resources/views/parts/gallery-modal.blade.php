<div id="selectModal" class="modal fade js-modal" id="basic" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

                <h4 class="modal-title">{{ _('Sliders') }}</h4>
            </div>
            <div class="modal-body">

                <form class="js-modal-search-form">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn blue" type="submit">
                                {{ _('Search') }}
                            </button>
                        </span>
                    </div>
                </form>

                <div class="js-modal-body"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">{{ _('Cansel') }}</button>
                <button type="button" class="js-save btn green">{{ _('Insert') }}</button>
            </div>
        </div>
    </div>
</div>
