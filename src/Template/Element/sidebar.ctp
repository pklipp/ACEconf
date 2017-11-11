<aside id="sidebar-left" class="sidebar-left">

  <div class="sidebar-header">
    <div class="sidebar-title">
      Navigation
    </div>
    <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html"
        data-fire-event="sidebar-left-toggle">
      <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
    </div>
  </div>

  <div class="nano">
    <div class="nano-content">
      <nav id="menu" class="nav-main" role="navigation">
        <ul class="nav nav-main">
            <?php foreach ($items as $item): ?>
                <?php
                $classes = '';
                if (isset($item['children'])) {
                    $classes .= 'nav-parent ';
                    if (isset($item['active']) && $item['active']) {
                        $classes .= 'nav-expanded ';
                    }
                }
                if (isset($item['active']) && $item['active']) {
                    $classes .= 'nav-active';
                }
                ?>
              <li class="<?= trim($classes) ?>">
                  <?php
                  if (!isset($item['link']) || !$item['link']) {
                      $link = '#';
                  } else {
                      $link = $item['link'];
                  }
                  ?>
                  <?= $this->Html->link(
                      '<i class="fa fa-' . $item['icon'] . '" aria-hidden="true"></i><span>' . $item['name'] . '</span>',
                      $link,
                      ['escape' => false]
                  ) ?>
                  <?php if (isset($item['children'])): ?>
                    <ul class="nav nav-children">
                        <?php foreach ($item['children'] as $children): ?>
                          <li class="<?= (isset($children['active']) && $children['active']) ? 'nav-active' : '' ?>">
                              <?php
                              if (isset($children['icon'])) {
                                  $name = '<i class="fa fa-' . $children['icon'] . '" aria-hidden="true"></i><span>' . $children['name'] . '</span>';
                              } else {
                                  $name = $children['name'];
                              }
                              ?>
                              <?= $this->Html->link(
                                  $name,
                                  $children['link'],
                                  ['escape' => false]
                              ) ?>
                          </li>
                        <?php endforeach; ?>
                    </ul>
                  <?php endif; ?>
              </li>
            <?php endforeach; ?>
        </ul>
      </nav>
    </div>

    <script>
      // Maintain Scroll Position
      if (typeof localStorage !== 'undefined') {
        if (localStorage.getItem('sidebar-left-position') !== null) {
          var initialPosition = localStorage.getItem('sidebar-left-position'),
            sidebarLeft = document.querySelector('#sidebar-left .nano-content');

          sidebarLeft.scrollTop = initialPosition;
        }
      }
    </script>
  </div>
</aside>