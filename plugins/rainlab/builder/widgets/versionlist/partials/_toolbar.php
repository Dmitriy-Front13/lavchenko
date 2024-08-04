<div class="layout-row min-size panel-contents">
    <div class="control-toolbar toolbar-padded">
        <div class="toolbar-item" data-calculate-width>
            <div class="btn-group">
                <div class="dropdown">
                    <button type="button" class="btn btn-default oc-icon-plus"
                        data-toggle="dropdown"
                        ><?= e(trans('rainlab.builder::lang.common.add')) ?></button>

                    <ul class="dropdown-menu" role="menu" data-dropdown-title="<?= e(trans('cms::lang.asset.drop_down_add_title')) ?>">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:;" data-builder-command="version:cmdCreateVersion" data-version-type="custom" class="oc-icon-repeat"><?= e(trans('rainlab.builder::lang.version.custom')) ?></a></li>

                        <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:;" data-builder-command="version:cmdCreateVersion" data-version-type="migration" class="oc-icon-table"><?= e(trans('rainlab.builder::lang.version.migration')) ?></a></li>

                        <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:;" data-builder-command="version:cmdCreateVersion" data-version-type="seeder" class="oc-icon-th"><?= e(trans('rainlab.builder::lang.version.seeder')) ?></a></li>
                    </ul>
                </div>
                <?= $this->makePartial('sort'); ?>
            </div>
        </div>
        <div class="relative toolbar-item loading-indicator-container size-input-text">
            <input
                type="text"
                name="search"
                value="<?= e($this->getSearchTerm()) ?>"
                class="form-control icon search" autocomplete="off"
                placeholder="<?= e(trans('rainlab.builder::lang.version.search')) ?>"
                data-track-input
                data-load-indicator
                data-load-indicator-opaque
                data-request="<?= $this->getEventHandler('onSearch') ?>"
            />
        </div>
    </div>
</div>
