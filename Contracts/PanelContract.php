<?php

declare(strict_types=1);

namespace Modules\Xot\Contracts;

use Illuminate\Database\Eloquent\Builder;
//use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Collection;

interface PanelContract {
    //public Model $row;

    public function setRow(Model $row): self;

    /**
     * Undocumented function.
     *
     * @param Builder|Relation $rows
     */
    public function setRows($rows): self;

    /**
     * Undocumented function.
     *
     * @return Builder|Relation
     */
    public function getRows();

    public function setItem(string $guid): self;

    public function setParent(?PanelContract $panel): PanelContract;

    /**
     * Undocumented function.
     *
     * @return Builder|Relation
     */
    public function rows(?array $data = null);

    /**
     * @return mixed
     */
    public function update(array $data);

    /**
     * Undocumented function.
     *
     * @return mixed
     */
    public function view(?array $params = null);

    /**
     * Undocumented function.
     *
     * @return mixed
     */
    public function itemAction(string $act);

    public function relatedUrl(array $params = []): string;

    public function setLabel(string $label): Model;

    public function postType(): string;

    public function imgSrc(array $params): string;

    public function optionLabel(object $row): string;

    public function getRow(): Model;

    /**
     * Undocumented function.
     *
     * @return mixed
     */
    public function pdf(array $params = []);

    public function pdfFilename(array $params = []): string;

    public function setInAdmin(bool $in_admin): void;

    public function setRouteParams(array $route_params): void;

    public function getXotModelName(): ?string;

    public function url(array $params = []): string;

    public function itemActions(array $params = []): Collection;

    public function id(?bool $is_admin = null): string;

    public function title(): ?string;

    public function with(): array;

    public function setName(string $name): self;

    public function tabs(): array;

    public function getBreads(): Collection;

    public function getRouteParams(): array;

    public function guid(?bool $is_admin = null): ?string;

    public function getParent(): ?PanelContract;

    public function fields(): array;

    public function actions(): array;

    public function getModuleNameLow(): string;

    public function getModuleName(): string;

    public function getName(): string;

    public function rules(array $params = []): array;

    public function rulesMessages(): array;

    /**
     * Undocumented function.
     *
     * @return mixed
     */
    public function callAction(string $act);

    /**
     * Undocumented function.
     *
     * @return mixed
     */
    public function out(array $params = []);

    /**
     * Undocumented function.
     *
     * @return mixed
     */
    public function callItemActionWithGate(string $act);

    public function getParents(): Collection;

    /*
    public function __construct($model = null);





    public function initRows();

    public function setParent($parent);



    public function findParentType($type);

    public function optionId(object $row);





    public function hasLang();

    public function setLabel($label);

    public function optionsSelect();

    public function options($data = null);

    public function optionsTree($data = null);

    public function optionIdName();

    public function optionLabelName();

    public function search();

    public function orderBy();


    public function pivotRules($params);

    public function rulesMessages();

    public function filters(Request $request = null);

    public function getXotModelName();

    public function indexNav(): ?\Illuminate\Contracts\Support\Renderable;

    public function getActions(array $params = []);

    public function containerActions(array $params = []);

    public function itemActions(array $params = []);

    public function itemAction($act);

    public function containerAction($act);

    public function urlContainerAction($act);

    public function urlItemAction($act);

    public function btnItemAction($act);

    public static function indexQuery(array $data, $query);

    public static function relatableQuery(Request $request, $query);

    public function applyJoin($query);

    public function applyFilter($query, $filters);

    public function applySearch($query, $q);

    public function applySort($query, $sort);

    public function formatItemData($item, $params);

    public function formatData($data, $params);

    public function indexRows(Request $request, $query);

    public function formCreate(array $params = []);

    public function formEdit(array $params = []);

    public function exceptFields(array $params = []);

    public function indexFields();

    public function createFields();

    public function editFields();

    public function indexEditFields();

    public function addQuerystringsUrl($params);

    public function yearNavRedirect();

    public function yearNav();

    public function monthYearNav();

    public function btnSubmit();

    public function btnDelete(array $params = []);

    public function btnDetach(array $params = []);

    public function btnCrud(array $params = []);

    public function btnHtml($params);

    public function btn($act, $params = []);

    public function imageHtml($params);



    public function microdataSchemaOrg();

    public function show_ldJson();

    public function langUrl($lang);



    public function relatedUrl($params);

    public function relatedName($name, $id = null);

    public function url(array $params = []);


    public function indexEditUrl();

    public function editUrl();

    public function updateUrl();

    public function showUrl();

    public function createUrl();

        public function destroyUrl();

    public function detachUrl();

    public function gearUrl();



    public function guid();

    public function getItemTabs();

    public function getRowTabs();

    public function getTabs();

    public function rows($data = null);

    public function callItemActionWithGate($act);

    public function callAction($act);

    public function callItemAction($act);

    public function callContainerAction($act);

    public function out(array $params = []);



    public function pdf(array $params = []);

    public static function getInstance();

    public function related($relationship);

    public function getModuleName();

    public function getModuleNameLow();

    public function breadcrumbs();

    public function getExcerpt($length = 225);

    public function indexEditSubs();

    public function swiperItem();

    public function dataTable();



    public function id();
    */
}
