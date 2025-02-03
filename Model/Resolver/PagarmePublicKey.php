<?php

declare(strict_types=1);

namespace SuperFrete\PagarmeGraphql\Model\Resolver;

use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Pagarme\Pagarme\Gateway\Transaction\Base\Config\ConfigInterface;

class PagarmePublicKey implements ResolverInterface
{
    protected ConfigInterface $config;

    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }

    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        return $this->config->getPublicKey();
    }
}
