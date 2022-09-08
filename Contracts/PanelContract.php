<?php

declare(strict_types=1);

namespace Modules\Xot\Contracts;

<<<<<<< HEAD
// use Illuminate\Database\Query\Builder;
=======
//use Illuminate\Database\Query\Builder;
>>>>>>> 9472ad4 (first)
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Modules\Xot\Models\Panels\Actions\XotBasePanelAction;

/**
 * Undocumented interface.
 *
 * @property Model $row
 */
interface PanelContract {
    public function setRow(Model $row): self;

<<<<<<< HEAD
    // public function setRows(Relation $rows): self;
=======
    //public function setRows(Relation $rows): self;
>>>>>>> 9472ad4 (first)

    /**
     * Undocumented function.
     *
     * @param Relation|Builder $rows
     */
    public function setRows($rows): self;

    /**
     * Undocumented function.
     *
     * @return Relation|Builder
     */
    public function getRows();

    public function setItem(string $guid): self;

<<<<<<< HEAD
    public function setParent(?self $panel): self;
=======
    public function setParent(?PanelContract $panel): PanelContract;
>>>>>>> 9472ad4 (first)

    /**
     * Undocumented function.
     *
     * @return RowsContract
     */
    public function rows(?array $data = null);

    /**
<<<<<<< HEAD
     * ---.
     */
    public function update(array $data): self;
=======
     * @return mixed
     */
    public function update(array $data);
>>>>>>> 9472ad4 (first)

    /**
     * Ritorna la view.
     *
     * @return View
     */
    public function view(?array $params = null);

    /**
     * Undocumented function.
     *
<<<<<<< HEAD
     * @return PanelActionContract
=======
     * @return mixed
>>>>>>> 9472ad4 (first)
     */
    public function itemAction(string $act);

    public function relatedUrl(string $name, string $act = 'index'): string;

    public function setLabel(string $label): Model;

    public function postType(): string;

    public function imgSrc(array $params): string;

    public function getRow(): Model;

    /**
     * Undocumented function.
     *
     * @return \Illuminate\Http\File|\Illuminate\Http\UploadedFile|\Psr\Http\Message\StreamInterface|resource|string
     */
    public function pdf(array $params = []);

    public function pdfFilename(array $params = []): string;

    public function setInAdmin(bool $in_admin): self;

    public function setRouteParams(array $route_params): void;

    public function getXotModelName(): ?string;

    public function url(string $act = 'show'): string;

<<<<<<< HEAD
    /**
     * Undocumented function.
     *
     * @return Collection<XotBasePanelAction>
     */
=======
>>>>>>> 9472ad4 (first)
    public function itemActions(array $params = []): Collection;

    public function id(?bool $is_admin = null): string;

    public function title(): ?string;

    public function with(): array;

    public function setName(string $name): self;

    public function tabs(): array;

    /**
     * @return Collection&iterable<PanelContract>
     */
    public function getBreads();

    public function getRouteParams(): array;

    public function guid(?bool $is_admin = null): ?string;

<<<<<<< HEAD
    public function getParent(): ?self;
=======
    public function getParent(): ?PanelContract;
>>>>>>> 9472ad4 (first)

    public function fields(): array;

    public function actions(): array;

    public function getModuleNameLow(): string;

    public function getModuleName(): string;

    public function getName(): string;

    /**
     * @return mixed
     */
    public function getOrderField();

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

    /**
     * Undocumented function.
     *
     * @return Collection<PanelContract>
     */
    public function getParents();

    /**
<<<<<<< HEAD
     * ---.
     */
    public function formLivewireEdit(array $params = []): string;
=======
     * @return mixed
     */
    public function formLivewireEdit(array $params = []);
>>>>>>> 9472ad4 (first)

    public function getFields(array $params = []): Collection;

    public function isRevisionBy(UserContract $user): bool;

<<<<<<< HEAD
    public function isAuthoredBy(UserContract $user): bool;

    public function isModeratedBy(UserContract $user): bool;

    public function isAdminedBy(UserContract $user): bool;

    public function related(string $relationship): self;

    public function relatedName(string $name, ?int $id = null): self;
=======
    public function related(string $relationship): PanelContract;

    public function relatedName(string $name, ?int $id = null): PanelContract;
>>>>>>> 9472ad4 (first)

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public function getBuilder();

    public function getTradMod(): string;

    /**
     * Undocumented function.
     */
    public function filters(): array;

    /**
     * @return int|string|null
     */
    public function optionId(Model $row);

    public function optionLabel(Model $row): string;

<<<<<<< HEAD
    // public function isInternalPage(): bool;
=======
    //public function isInternalPage(): bool;
>>>>>>> 9472ad4 (first)

    public function rules(array $params = []): array;

    public function getRules(array $params = []): array;

    public function rulesMessages(): array;

<<<<<<< HEAD
    // --------------------- ACTIONS -------------------
=======
    //--------------------- ACTIONS -------------------
>>>>>>> 9472ad4 (first)

    /**
     * @return mixed
     */
    public function urlContainerAction(string $act, array $params = []);

    /**
     * crea l'oggetto del pannello Container (quello dove passi $rowS).
     */
    public function containerAction(string $act): XotBasePanelAction;
}
