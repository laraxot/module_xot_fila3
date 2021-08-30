<?php

declare(strict_types=1);

namespace Modules\Xot\Contracts;

use Illuminate\Database\Eloquent\Model;

interface PanelContract {
    //public Model $row;

    /**
     * Undocumented function.
     *
     * @param Model|ModelContract|ModelContract[] $rows
     */
    public function setRows($rows): self;

    public function setItem(string $guid): self;

    public function setParent(?PanelContract $panel): PanelContract;

    /**
     * Undocumented function.
     *
     * @return mixed
     */
    public function view(?array $params = null);

    /**
     * Undocumented function.
     *
     * @param string $act
     *
     * @return mixed
     */
    public function itemAction($act);

    public function relatedUrl(array $params = []): string;

    public function setLabel(string $label): ModelContract;

    public function postType(): string;

    public function imgSrc(array $params): string;

    public function optionLabel(object $row): string;

    /**
     * Undocumented function.
     *
     * @return object|Model
     */
    public function getRow();

    /*
    public function __construct($model = null);

    public function setRow($row);



    public function initRows();

    public function setParent($parent);

    public function getParents();

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

    public function rules(array $params = []);

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

    public function indexUrl();

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

    public function pdfFilename(array $params = []);

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