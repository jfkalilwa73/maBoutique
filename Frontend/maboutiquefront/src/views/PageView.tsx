import { renderPage } from '../application/pageRegistry'
import type { AppViewModel } from '../application/types/AppViewModel'

export interface PageViewProps {
  viewModel: AppViewModel
}

/** Vue : délègue le choix de l’écran au registre (OCP) */
export function PageView({ viewModel }: PageViewProps) {
  return <>{renderPage(viewModel)}</>
}
