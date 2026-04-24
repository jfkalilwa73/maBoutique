import type { ReactNode } from 'react'
import type { AppViewModel } from './types/AppViewModel'
import type { PageKey } from '../models/types'
import { AtelierView } from '../views/AtelierView'
import { CatalogueView } from '../views/CatalogueView'
import { CommercantView } from '../views/CommercantView'
import { InscriptionView } from '../views/InscriptionView'
import { LoginView } from '../views/LoginView'

type PageRenderer = (viewModel: AppViewModel) => ReactNode

/**
 * O — Open/closed : ajouter une page = ajouter une entrée ici + la clé dans PageKey,
 *     sans retoucher un gros switch ailleurs.
 * L — Chaque rendu reçoit le même AppViewModel (contrat stable).
 */
const PAGE_RENDERERS = {
  connexion: (vm: AppViewModel) => <LoginView onSubmit={vm.submitLogin} onBrowseCatalog={vm.browseCatalogAsGuest} />,

  inscription: (vm: AppViewModel) => <InscriptionView onGoToLogin={() => vm.navigate('connexion')} />,

  catalogue: () => <CatalogueView />,

  commercant: (vm: AppViewModel) => (
    <CommercantView merchantNav={vm.merchantNav} onMerchantNavChange={vm.setMerchantNav} />
  ),

  atelier: () => <AtelierView />,
} satisfies Record<PageKey, PageRenderer>

export function renderPage(viewModel: AppViewModel): ReactNode {
  return PAGE_RENDERERS[viewModel.activePage](viewModel)
}
