<?php

declare(strict_types=1);

namespace Esgi\Car\Api\Data;

/**
 * Esgi brand interface.
 * @api
 */
interface BrandInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ID = 'entity_id';
    const TITLE = 'title';
    const CONTENT = 'content';
    const PRODUCTS = 'products';
    /**#@-*/

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get name
     *
     * @return string|null
     */
    public function getTitle();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent();

    /**
     * Get products
     *
     * @return string|null
     */
    public function getProducts();


    /**
     * Set ID
     *
     * @param int $id
     * @return BrandInterface
     */
    public function setId($id);

    /**
     * Set name
     *
     * @param string $title
     * @return BrandInterface
     */
    public function setTitle($title);

    /**
     * Set content
     *
     * @param string $content
     * @return BrandInterface
     */
    public function setContent($content);


    /**
     * Set products
     *
     * @param string $products
     * @return BrandInterface
     */
    public function setProducts($products);
}

