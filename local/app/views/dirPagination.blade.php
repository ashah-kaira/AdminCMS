<div>
    <section id="paginations">
        <div class="">
            <ul class="pagination pagination-sm no-margin pull-right" ng-if="1 < pages.length">
                <li ng-if="boundaryLinks" ng-class="{ disabled : pagination.current == 1 }">
                    <a href="" ng-click="setCurrent(1)">&laquo;</a>
                </li>
                <li ng-if="directionLinks" ng-class="{ disabled : pagination.current == 1 }" class="ng-scope">
                    <a href="" ng-click="setCurrent(pagination.current - 1)" class="ng-binding">Prev</a>
                </li>
                <li ng-repeat="pageNumber in pages track by $index" ng-class="{ active : pagination.current == pageNumber, disabled : pageNumber == '...' }" class="mobile-view">
                    <a href="" ng-click="setCurrent(pageNumber)">@{{ pageNumber }}</a>
                </li>
                <li ng-if="directionLinks" ng-class="{ disabled : pagination.current == pagination.last }" class="ng-scope">
                    <a href="" ng-click="setCurrent(pagination.current + 1)" class="ng-binding">Next</a>
                </li>
                <li ng-if="boundaryLinks" ng-class="{ disabled : pagination.current == pagination.last }">
                    <a href="" ng-click="setCurrent(pagination.last)">&raquo;</a>
                </li>
            </ul>
        </div>
    </section>
</div>
