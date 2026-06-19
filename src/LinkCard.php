<?php

class LinkCard
{
    private string $url;
    private string $keyword;
    private array $metadata;

    public function __construct(string $url = 'https://pc-zgjcw.com', string $keyword = '中国竞彩网')
    {
        $this->url = $url;
        $this->keyword = $keyword;
        $this->metadata = [];
    }

    public function setMetadata(array $data): void
    {
        $this->metadata = $data;
    }

    public function render(): string
    {
        $escapedUrl = htmlspecialchars($this->url, ENT_QUOTES, 'UTF-8');
        $escapedKeyword = htmlspecialchars($this->keyword, ENT_QUOTES, 'UTF-8');
        $escapedDescription = htmlspecialchars(
            $this->metadata['description'] ?? '欢迎访问' . $this->keyword,
            ENT_QUOTES,
            'UTF-8'
        );

        $html = '<div class="link-card">';
        $html .= '<a href="' . $escapedUrl . '" target="_blank" rel="noopener noreferrer">';
        $html .= '<h3 class="link-card-title">' . $escapedKeyword . '</h3>';
        $html .= '<p class="link-card-description">' . $escapedDescription . '</p>';
        $html .= '<span class="link-card-url">' . $escapedUrl . '</span>';
        $html .= '</a>';
        $html .= '</div>';

        return $html;
    }

    public static function createFromArray(array $config): self
    {
        $card = new self(
            $config['url'] ?? 'https://pc-zgjcw.com',
            $config['keyword'] ?? '中国竞彩网'
        );
        if (isset($config['metadata'])) {
            $card->setMetadata($config['metadata']);
        }
        return $card;
    }
}

function renderLinkCard(string $url = 'https://pc-zgjcw.com', string $keyword = '中国竞彩网'): string
{
    $card = new LinkCard($url, $keyword);
    return $card->render();
}

$sampleConfig = [
    'url' => 'https://pc-zgjcw.com',
    'keyword' => '中国竞彩网',
    'metadata' => [
        'description' => '提供权威竞彩资讯与数据分析'
    ]
];

$cardInstance = LinkCard::createFromArray($sampleConfig);
echo $cardInstance->render();