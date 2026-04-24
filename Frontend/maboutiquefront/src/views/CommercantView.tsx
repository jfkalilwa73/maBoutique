import { MERCHANT_NAV_ITEMS } from '../models/navigation'
import type { MerchantNavKey } from '../models/types'
import { MerchantPanelView } from './MerchantPanelView'

export interface CommercantViewProps {
  merchantNav: MerchantNavKey
  onMerchantNavChange: (key: MerchantNavKey) => void
}

/** Vue : shell dashboard commerçant (sidebar + panneau) */
export function CommercantView({ merchantNav, onMerchantNavChange }: CommercantViewProps) {
  return (
    <section className="dashboard">
      <aside className="side-nav">
        <h4>Espace Commerçant</h4>
        <nav aria-label="Espace commerçant">
          {MERCHANT_NAV_ITEMS.map((item) => (
            <button
              key={item.key}
              type="button"
              className={merchantNav === item.key ? 'side-nav-item is-active' : 'side-nav-item'}
              onClick={() => onMerchantNavChange(item.key)}
            >
              {item.label}
            </button>
          ))}
        </nav>
      </aside>
      <div className="board">
        <MerchantPanelView section={merchantNav} />
      </div>
    </section>
  )
}
