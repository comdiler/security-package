<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Magento\TwoFactorAuth\Model\Config;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\TwoFactorAuth\Api\UserNotifierInterface;

/**
 * Represents configuration for notifying the user in webapi areas
 */
class WebApiUserNotifier extends UserNotifier
{
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Get the url to send to the user for configuring personal 2fa settings
     *
     * @param string $tfaToken
     * @return string|null
     */
    public function getPersonalRequestConfigUrl(string $tfaToken): ?string
    {
        $userUrl = $this->scopeConfig->getValue(UserNotifierInterface::XML_PATH_WEBAPI_NOTIFICATION_URL);

        if ($userUrl) {
            return str_replace(':tfat', $tfaToken, $userUrl);
        }

        return parent::getPersonalRequestConfigUrl($tfaToken);
    }
}
