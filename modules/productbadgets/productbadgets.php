<?php
/**
 * productbadges.php - Módulo principal ProductBadges para PrestaShop 1.7
 *
 * Gestiona etiquetas visuales reutilizables para productos del catálogo.
 * El ObjectModel ProductBadge está definido en este mismo fichero al no
 * justificarse una carpeta classes/ para una única entidad pequeña.
 *
 * @author    Pablo
 * @license   MIT
 * @version   1.0.0
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

// =============================================================================
// ObjectModel — ProductBadge
// =============================================================================

class ProductBadge extends ObjectModel
{
    /** @var string Color de fondo (#RRGGBB) */
    public $bg_color = '#FF0000';

    /** @var string Color del texto (#RRGGBB) */
    public $text_color = '#FFFFFF';

    /** @var string Posición: top-left | top-right */
    public $position = 'top-left';

    /** @var bool Activa/inactiva */
    public $active = true;

    /** @var string (multilenguaje) Texto de la badge */
    public $badge_text;

    /** @var string Fecha de creación */
    public $date_add;

    /** @var string Fecha de actualización */
    public $date_upd;

    /** @var array */
    public static $definition = [
        'table'     => 'productbadge',
        'primary'   => 'id_badge',
        'multilang' => true,
        'fields'    => [
            'bg_color'   => ['type' => self::TYPE_STRING, 'size' => 7,   'validate' => 'isColor',       'required' => true],
            'text_color' => ['type' => self::TYPE_STRING, 'size' => 7,   'validate' => 'isColor',       'required' => true],
            'position'   => ['type' => self::TYPE_STRING, 'size' => 10,  'validate' => 'isGenericName', 'required' => true],
            'active'     => ['type' => self::TYPE_BOOL,   'validate' => 'isBool'],
            'date_add'   => ['type' => self::TYPE_DATE,   'validate' => 'isDate'],
            'date_upd'   => ['type' => self::TYPE_DATE,   'validate' => 'isDate'],
            'badge_text' => ['type' => self::TYPE_STRING, 'size' => 255, 'validate' => 'isGenericName', 'lang' => true, 'required' => true],
        ],
    ];

    /** @return int[] */
    public function getLinkedProducts(): array
    {
        $rows = Db::getInstance()->executeS(
            'SELECT `id_product` FROM `' . _DB_PREFIX_ . 'productbadge_product`
             WHERE `id_badge` = ' . (int) $this->id
        );

        return is_array($rows) ? array_column($rows, 'id_product') : [];
    }

    /** @param int[] $productIds */
    public function setLinkedProducts(array $productIds): bool
    {
        Db::getInstance()->delete('productbadge_product', '`id_badge` = ' . (int) $this->id);

        if (empty($productIds)) {
            return true;
        }

        $insert = [];
        foreach ($productIds as $idProduct) {
            $idProduct = (int) $idProduct;
            if ($idProduct > 0) {
                $insert[] = ['id_badge' => (int) $this->id, 'id_product' => $idProduct];
            }
        }

        return empty($insert) || (bool) Db::getInstance()->insert('productbadge_product', $insert);
    }

    /** @return array<int, array<string, mixed>>|false */
    public static function getList(int $idLang, int $start = 0, int $limit = 50, string $orderBy = 'id_badge', string $orderWay = 'ASC')
    {
        $allowedOrderBy = ['id_badge', 'badge_text', 'position', 'active'];
        if (!in_array($orderBy, $allowedOrderBy, true)) {
            $orderBy = 'id_badge';
        }
        $orderWay = strtoupper($orderWay) === 'DESC' ? 'DESC' : 'ASC';

        $sql = new DbQuery();
        $sql->select("b.id_badge, IFNULL(bl.badge_text, '') AS badge_text, b.bg_color, b.text_color, b.position, b.active");
        $sql->from('productbadge', 'b');
        $sql->leftJoin('productbadge_lang', 'bl', 'b.id_badge = bl.id_badge AND bl.id_lang = ' . $idLang);
        $sql->orderBy('b.`' . bqSQL($orderBy) . '` ' . $orderWay);
        $sql->limit($limit, $start);

        return Db::getInstance()->executeS($sql);
    }

    public static function countAll(): int
    {
        return (int) Db::getInstance()->getValue('SELECT COUNT(*) FROM `' . _DB_PREFIX_ . 'productbadge`');
    }
}

// =============================================================================
// Módulo principal — ProductBadges
// =============================================================================

class ProductBadgets extends Module
{
    public function __construct()
    {
        $this->name = 'productbadgets';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Blinders Group';
        $this->need_instance = 0;
        
        $this->ps_versions_compliancy = [
            'min' => '1.7.8.0', 
            'max' => '1.7.8.99'
        ];
        
        $this->bootstrap = true;

        parent::__construct();

        // Nombre y descripción visibles en el panel de administración
        $this->displayName = $this->l('Product Badgets');
        $this->description = $this->l('Módulo para gestionar y mostrar distintivos (badges) en los productos.');

        $this->confirmUninstall = $this->l('¿Seguro que quieres desinstalar el módulo Product Badgets?');
    }

    /**
     * Método de instalación
     */
    public function install()
    {
        return parent::install()
            && $this->registerHook('displayHeader')
            && Configuration::updateValue('PRODUCTBADGETS_LIVE', false);
    }

    /**
     * Método de desinstalación
     */
    public function uninstall()
    {
        return parent::uninstall()
            && Configuration::deleteByName('PRODUCTBADGETS_LIVE');
    }

    /**
     * Hook para cargar estilos y scripts en el Front-Office
     */
    public function hookDisplayHeader($params)
    {
        $this->context->controller->addCSS($this->_path . 'views/css/front.css');
        $this->context->controller->addJS($this->_path . 'views/js/front.js');
    }

    /**
     * Panel de configuración en el Back-Office
     */
    public function getContent()
    {
        return $this->display(__FILE__, 'views/templates/admin/configure.tpl');
    }
}